<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Gift;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormUxTest extends TestCase
{
    use RefreshDatabase;

    public function test_direct_form_restores_custom_amount_after_validation_error(): void
    {
        $this->from('/doar/direto')->post('/checkout', [
            'amount' => 250,
            'payment_method' => 'pix',
        ])->assertRedirect('/doar/direto');

        $this->get('/doar/direto')
            ->assertOk()
            ->assertSee("customAmount: '250'", false);
    }

    public function test_direct_form_keeps_preset_selection_after_validation_error(): void
    {
        $this->from('/doar/direto')->post('/checkout', [
            'amount' => 200,
            'payment_method' => 'pix',
        ]);

        $this->get('/doar/direto')
            ->assertOk()
            ->assertSee('selectedAmount: 200', false);
    }

    public function test_checkout_restores_payment_method_after_validation_error(): void
    {
        $gift = Gift::factory()->create(['is_active' => true]);
        $this->post(route('cart.add', $gift));

        $this->from('/checkout')->post('/checkout', [
            'use_cart' => '1',
            'payment_method' => 'credit_card',
        ]);

        $this->get('/checkout')
            ->assertOk()
            ->assertSee("paymentMethod: 'credit_card'", false);
    }

    public function test_donor_name_validation_error_is_displayed(): void
    {
        $this->from('/doar/direto')->post('/checkout', [
            'amount' => 100,
            'donor_name' => str_repeat('a', 121),
            'donor_email' => 'tio@example.com',
            'donor_document' => '52998224725',
            'payment_method' => 'pix',
        ]);

        $this->get('/doar/direto')
            ->assertOk()
            ->assertSee('donor name field must not be greater than 120');
    }

    public function test_pix_page_distinguishes_missing_qr_from_unconfigured_gateway(): void
    {
        $withCharge = Donation::factory()->create([
            'status' => Donation::STATUS_PENDING,
            'payment_method' => 'pix',
            'asaas_payment_id' => 'pay_wait_qr',
            'asaas_payload' => ['charge' => ['id' => 'pay_wait_qr']],
        ]);

        $this->get(route('donation.pix', $withCharge))
            ->assertOk()
            ->assertSee('Recarregar', false)
            ->assertDontSee('ainda não foi configurado');

        $withoutCharge = Donation::factory()->create([
            'status' => Donation::STATUS_PENDING,
            'payment_method' => 'pix',
            'asaas_payment_id' => null,
        ]);

        $this->get(route('donation.pix', $withoutCharge))
            ->assertOk()
            ->assertSee('ainda não foi configurado');
    }

    public function test_reveal_animations_have_no_js_fallback(): void
    {
        $css = file_get_contents(resource_path('css/app.css'));

        $this->assertStringContainsString('reveal-fallback', $css);
    }

    public function test_donation_forms_guard_against_double_submit(): void
    {
        $gift = Gift::factory()->create(['is_active' => true]);
        $this->post(route('cart.add', $gift));

        $this->get('/checkout')
            ->assertOk()
            ->assertSee('submitting = true', false);

        $this->get('/doar/direto')
            ->assertOk()
            ->assertSee('submitting = true', false);
    }
}
