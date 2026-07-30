<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Gift;
use App\Services\AsaasClient;
use App\Services\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartContributionTest extends TestCase
{
    use RefreshDatabase;

    public function test_adding_without_an_amount_contributes_what_is_still_missing(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 50_000, 'raised_cents' => 20_000, 'is_active' => true]);

        $this->post(route('cart.add', $gift));

        $this->assertSame(30_000, app(Cart::class)->totalCents());
    }

    public function test_guest_can_contribute_a_partial_amount(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 230_000, 'raised_cents' => 0, 'is_active' => true]);

        $this->post(route('cart.add', $gift), ['amount' => 50]);

        $items = app(Cart::class)->items();

        $this->assertCount(1, $items);
        $this->assertSame(5_000, $items->first()['amount_cents']);
        $this->assertSame(5_000, app(Cart::class)->totalCents());
    }

    public function test_different_gifts_hold_independent_contributions(): void
    {
        $panelas = Gift::factory()->create(['price_cents' => 68_000, 'is_active' => true]);
        $louca = Gift::factory()->create(['price_cents' => 230_000, 'is_active' => true]);

        $this->post(route('cart.add', $panelas), ['amount' => 100]);
        $this->post(route('cart.add', $louca), ['amount' => 250]);

        $cart = app(Cart::class);

        $this->assertCount(2, $cart->items());
        $this->assertSame(35_000, $cart->totalCents());
    }

    public function test_contribution_cannot_exceed_what_is_missing(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 50_000, 'raised_cents' => 40_000, 'is_active' => true]);

        $this->post(route('cart.add', $gift), ['amount' => 300])
            ->assertSessionHasErrors('amount');

        $this->assertTrue(app(Cart::class)->isEmpty());
    }

    public function test_contribution_below_the_minimum_is_rejected(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 50_000, 'is_active' => true]);

        $this->post(route('cart.add', $gift), ['amount' => 3])
            ->assertSessionHasErrors('amount');

        $this->assertTrue(app(Cart::class)->isEmpty());
    }

    public function test_fully_funded_gift_cannot_be_added(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 50_000, 'raised_cents' => 50_000, 'is_active' => true]);

        $this->post(route('cart.add', $gift))->assertNotFound();

        $this->assertTrue(app(Cart::class)->isEmpty());
    }

    public function test_adding_the_same_gift_again_replaces_the_amount(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 100_000, 'is_active' => true]);

        $this->post(route('cart.add', $gift), ['amount' => 100]);
        $this->post(route('cart.add', $gift), ['amount' => 250]);

        $cart = app(Cart::class);

        $this->assertCount(1, $cart->items());
        $this->assertSame(25_000, $cart->totalCents());
    }

    public function test_contribution_can_be_updated_from_the_checkout(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 100_000, 'is_active' => true]);

        $this->post(route('cart.add', $gift), ['amount' => 100]);
        $this->post(route('cart.update', $gift), ['amount' => 400]);

        $this->assertSame(40_000, app(Cart::class)->totalCents());
    }

    public function test_cart_shrinks_a_stale_contribution_when_the_gift_gets_funded_meanwhile(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 100_000, 'raised_cents' => 0, 'is_active' => true]);

        $this->post(route('cart.add', $gift), ['amount' => 1000]);
        $this->assertSame(100_000, app(Cart::class)->totalCents());

        $gift->update(['raised_cents' => 70_000]);

        $this->assertSame(30_000, app(Cart::class)->totalCents());
    }

    public function test_cart_checkout_records_one_item_per_gift(): void
    {
        $panelas = Gift::factory()->create(['price_cents' => 68_000, 'is_active' => true]);
        $louca = Gift::factory()->create(['price_cents' => 230_000, 'is_active' => true]);

        $this->post(route('cart.add', $panelas), ['amount' => 100]);
        $this->post(route('cart.add', $louca), ['amount' => 250]);

        $this->post('/checkout', [
            'use_cart' => '1',
            'donor_email' => 'tio@example.com',
            'donor_document' => '52998224725',
            'payment_method' => 'pix',
        ]);

        $donation = Donation::query()->latest()->first();

        $this->assertSame(35_000, $donation->amount_cents);
        $this->assertCount(2, $donation->items);
        $this->assertSame(10_000, $donation->items->firstWhere('gift_id', $panelas->id)->amount_cents);
        $this->assertSame(25_000, $donation->items->firstWhere('gift_id', $louca->id)->amount_cents);
    }

    public function test_paying_a_multi_gift_cart_credits_every_gift(): void
    {
        $panelas = Gift::factory()->create(['price_cents' => 68_000, 'raised_cents' => 0, 'is_active' => true]);
        $louca = Gift::factory()->create(['price_cents' => 230_000, 'raised_cents' => 0, 'is_active' => true]);

        $this->post(route('cart.add', $panelas), ['amount' => 100]);
        $this->post(route('cart.add', $louca), ['amount' => 250]);

        $this->post('/checkout', [
            'use_cart' => '1',
            'donor_email' => 'tio@example.com',
            'donor_document' => '52998224725',
            'payment_method' => 'pix',
        ]);

        $donation = Donation::query()->latest()->first();

        app(AsaasClient::class)->applyChargeStatus($donation, ['id' => $donation->asaas_payment_id, 'status' => 'RECEIVED']);

        $this->assertSame(10_000, $panelas->fresh()->raised_cents);
        $this->assertSame(25_000, $louca->fresh()->raised_cents);
    }

    public function test_cart_checkout_clamps_a_contribution_that_went_stale(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 100_000, 'raised_cents' => 0, 'is_active' => true]);

        $this->post(route('cart.add', $gift), ['amount' => 1000]);

        $gift->update(['raised_cents' => 80_000]);

        $this->post('/checkout', [
            'use_cart' => '1',
            'donor_email' => 'tio@example.com',
            'donor_document' => '52998224725',
            'payment_method' => 'pix',
        ]);

        $donation = Donation::query()->latest()->first();

        $this->assertSame(20_000, $donation->amount_cents);
        $this->assertSame(20_000, $donation->items->first()->amount_cents);
    }

    public function test_checkout_with_an_empty_cart_is_rejected(): void
    {
        $response = $this->post('/checkout', [
            'use_cart' => '1',
            'donor_email' => 'tio@example.com',
            'donor_document' => '52998224725',
            'payment_method' => 'pix',
        ]);

        $response->assertSessionHasErrors('amount');
        $this->assertSame(0, Donation::query()->count());
    }

    public function test_checkout_renders_an_editable_amount_for_each_contribution(): void
    {
        $panelas = Gift::factory()->create(['name' => 'Kit de Panelas', 'price_cents' => 68_000, 'is_active' => true]);
        $louca = Gift::factory()->create(['name' => 'Máquina de lavar louças', 'price_cents' => 230_000, 'is_active' => true]);

        $this->post(route('cart.add', $panelas), ['amount' => 100]);
        $this->post(route('cart.add', $louca), ['amount' => 250]);

        $response = $this->get('/checkout');

        $response->assertOk()
            ->assertSee('Kit de Panelas')
            ->assertSee('Máquina de lavar louças')
            ->assertSee('cart-update-'.$panelas->id)
            ->assertSee('cart-update-'.$louca->id)
            ->assertSee('value="100.00"', false)
            ->assertSee('value="250.00"', false);
    }

    public function test_gift_listing_offers_an_amount_field_and_marks_funded_gifts(): void
    {
        $aberto = Gift::factory()->create(['name' => 'Adega dos Noivos', 'price_cents' => 100_000, 'raised_cents' => 40_000, 'is_active' => true]);
        $completo = Gift::factory()->create(['name' => 'Dia de Spa', 'price_cents' => 50_000, 'raised_cents' => 50_000, 'is_active' => true]);

        $response = $this->get('/presentes');

        $response->assertOk()
            ->assertSee('Contribuir')
            ->assertSee('Presenteado')
            ->assertSee('Faltam R$ 600,00')
            ->assertSee('value="600.00"', false);

        $this->assertStringNotContainsString(
            route('cart.add', $completo),
            $response->getContent(),
            'Presente 100% financiado não deve oferecer formulário de contribuição.'
        );

        $this->assertStringContainsString(route('cart.add', $aberto), $response->getContent());
    }

    public function test_cart_drops_a_gift_that_got_fully_funded_meanwhile(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 100_000, 'raised_cents' => 0, 'is_active' => true]);

        $this->post(route('cart.add', $gift), ['amount' => 500]);

        $gift->update(['raised_cents' => 100_000]);

        $cart = app(Cart::class);

        $this->assertCount(0, $cart->items());
        $this->assertTrue($cart->isEmpty());
    }
}
