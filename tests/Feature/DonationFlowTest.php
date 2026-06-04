<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Gift;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonationFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_direct_donation_creates_pending_donation_and_redirects_to_pix(): void
    {
        $response = $this->post('/checkout', [
            'amount' => 150,
            'donor_name' => 'Tio Carlos',
            'donor_email' => 'tio@example.com',
            'message' => 'Felicidades!',
            'payment_method' => 'pix',
        ]);

        $donation = Donation::query()->latest()->first();

        $this->assertNotNull($donation);
        $this->assertSame(Donation::STATUS_PENDING, $donation->status);
        $this->assertSame(15_000, $donation->amount_cents);
        $this->assertSame('Tio Carlos', $donation->donor_name);

        $response->assertRedirect(route('donation.pix', ['donation' => $donation]));
    }

    public function test_cart_donation_uses_cart_total(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 25_000, 'is_active' => true]);

        $this->post(route('cart.add', $gift));

        $this->post('/checkout', [
            'use_cart' => '1',
            'donor_email' => 'tio@example.com',
            'payment_method' => 'pix',
        ]);

        $donation = Donation::query()->latest()->first();
        $this->assertSame(25_000, $donation->amount_cents);
    }

    public function test_webhook_marks_donation_as_paid_and_increments_gift_raised(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 50_000, 'raised_cents' => 0, 'is_active' => true]);

        $donation = Donation::factory()->create([
            'gift_id' => $gift->id,
            'amount_cents' => 10_000,
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => 'pay_123',
        ]);

        $response = $this->postJson('/api/asaas-webhook', [
            'event' => 'PAYMENT_RECEIVED',
            'payment' => [
                'id' => 'pay_123',
                'status' => 'RECEIVED',
            ],
        ]);

        $response->assertOk();

        $donation->refresh();
        $gift->refresh();

        $this->assertSame(Donation::STATUS_PAID, $donation->status);
        $this->assertNotNull($donation->paid_at);
        $this->assertSame(10_000, $gift->raised_cents);
    }

    public function test_webhook_with_invalid_token_is_rejected(): void
    {
        config()->set('wedding.asaas.webhook_token', 'expected');

        $response = $this->postJson('/api/asaas-webhook', [
            'payment' => ['id' => 'x', 'status' => 'RECEIVED'],
        ]);

        $response->assertStatus(401);
    }
}
