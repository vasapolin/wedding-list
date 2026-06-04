<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Gift;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
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
            'donor_document' => '529.982.247-25',
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
            'donor_document' => '52998224725',
            'payment_method' => 'pix',
        ]);

        $donation = Donation::query()->latest()->first();
        $this->assertSame(25_000, $donation->amount_cents);
    }

    public function test_donation_without_document_is_rejected(): void
    {
        $response = $this->post('/checkout', [
            'amount' => 100,
            'donor_email' => 'tio@example.com',
            'payment_method' => 'pix',
        ]);

        $response->assertSessionHasErrors('donor_document');
        $this->assertSame(0, Donation::query()->count());
    }

    public function test_donation_with_invalid_document_is_rejected(): void
    {
        $response = $this->post('/checkout', [
            'amount' => 100,
            'donor_email' => 'tio@example.com',
            'donor_document' => '111.111.111-11',
            'payment_method' => 'pix',
        ]);

        $response->assertSessionHasErrors('donor_document');
        $this->assertSame(0, Donation::query()->count());
    }

    public function test_donor_document_is_stored_with_digits_only(): void
    {
        $this->post('/checkout', [
            'amount' => 100,
            'donor_email' => 'tio@example.com',
            'donor_document' => '529.982.247-25',
            'payment_method' => 'pix',
        ]);

        $donation = Donation::query()->latest()->first();
        $this->assertSame('52998224725', $donation->donor_document);
    }

    public function test_asaas_customer_is_created_with_cpf_cnpj(): void
    {
        config()->set('wedding.asaas.api_key', 'test-key');

        Http::fake([
            'api-sandbox.asaas.com/v3/customers*' => Http::sequence()
                ->push(['data' => []])
                ->push(['id' => 'cus_1']),
            'api-sandbox.asaas.com/v3/payments' => Http::response([
                'id' => 'pay_1',
                'status' => 'PENDING',
                'invoiceUrl' => 'https://sandbox.asaas.com/i/pay_1',
            ]),
            'api-sandbox.asaas.com/v3/payments/pay_1/pixQrCode' => Http::response([
                'payload' => 'pix-copy-paste',
                'encodedImage' => base64_encode('img'),
                'expirationDate' => now()->addDay()->toDateTimeString(),
            ]),
        ]);

        $this->post('/checkout', [
            'amount' => 100,
            'donor_name' => 'Tio Carlos',
            'donor_email' => 'tio@example.com',
            'donor_document' => '529.982.247-25',
            'payment_method' => 'pix',
        ]);

        Http::assertSent(function ($request) {
            return $request->method() === 'POST'
                && str_ends_with($request->url(), '/customers')
                && $request['cpfCnpj'] === '52998224725';
        });
    }

    public function test_credit_card_donation_redirects_to_asaas_secure_page(): void
    {
        config()->set('wedding.asaas.api_key', 'test-key');

        Http::fake([
            'api-sandbox.asaas.com/v3/customers*' => Http::sequence()
                ->push(['data' => []])
                ->push(['id' => 'cus_1']),
            'api-sandbox.asaas.com/v3/payments' => Http::response([
                'id' => 'pay_card_1',
                'status' => 'PENDING',
                'invoiceUrl' => 'https://sandbox.asaas.com/i/pay_card_1',
            ]),
        ]);

        $response = $this->post('/checkout', [
            'amount' => 200,
            'donor_email' => 'tio@example.com',
            'donor_document' => '52998224725',
            'payment_method' => 'credit_card',
        ]);

        $response->assertRedirect('https://sandbox.asaas.com/i/pay_card_1');

        $donation = Donation::query()->latest()->first();
        $this->assertSame('credit_card', $donation->payment_method);
        $this->assertSame('pay_card_1', $donation->asaas_payment_id);

        Http::assertSent(function ($request) use ($donation) {
            if ($request->method() !== 'POST' || ! str_ends_with($request->url(), '/payments')) {
                return false;
            }

            return $request['billingType'] === 'CREDIT_CARD'
                && $request['callback']['successUrl'] === route('donation.status', $donation);
        });

        Http::assertNotSent(fn ($request) => str_contains($request->url(), 'pixQrCode'));
    }

    public function test_credit_card_without_asaas_key_falls_back_to_status_page(): void
    {
        $response = $this->post('/checkout', [
            'amount' => 200,
            'donor_email' => 'tio@example.com',
            'donor_document' => '52998224725',
            'payment_method' => 'credit_card',
        ]);

        $donation = Donation::query()->latest()->first();
        $response->assertRedirect(route('donation.pix', ['donation' => $donation]));
    }

    public function test_pix_donation_still_generates_qr_code(): void
    {
        config()->set('wedding.asaas.api_key', 'test-key');

        Http::fake([
            'api-sandbox.asaas.com/v3/customers*' => Http::sequence()
                ->push(['data' => []])
                ->push(['id' => 'cus_1']),
            'api-sandbox.asaas.com/v3/payments' => Http::response([
                'id' => 'pay_pix_1',
                'status' => 'PENDING',
                'invoiceUrl' => 'https://sandbox.asaas.com/i/pay_pix_1',
            ]),
            'api-sandbox.asaas.com/v3/payments/pay_pix_1/pixQrCode' => Http::response([
                'payload' => 'pix-copy-paste',
                'encodedImage' => base64_encode('img'),
                'expirationDate' => now()->addDay()->toDateTimeString(),
            ]),
        ]);

        $response = $this->post('/checkout', [
            'amount' => 100,
            'donor_email' => 'tio@example.com',
            'donor_document' => '52998224725',
            'payment_method' => 'pix',
        ]);

        $donation = Donation::query()->latest()->first();
        $response->assertRedirect(route('donation.pix', ['donation' => $donation]));

        $this->assertSame('pix-copy-paste', $donation->asaas_payload['qr']['payload']);

        Http::assertSent(fn ($request) => str_ends_with($request->url(), '/payments')
            && $request['billingType'] === 'PIX');
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

    public function test_webhook_with_valid_token_is_accepted(): void
    {
        config()->set('wedding.asaas.webhook_token', 'expected');

        $donation = Donation::factory()->create([
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => 'pay_tok',
        ]);

        $this->postJson('/api/asaas-webhook', [
            'event' => 'PAYMENT_RECEIVED',
            'payment' => ['id' => 'pay_tok', 'status' => 'RECEIVED'],
        ], ['asaas-access-token' => 'expected'])->assertOk();

        $this->assertSame(Donation::STATUS_PAID, $donation->fresh()->status);
    }

    public function test_webhook_is_idempotent_on_duplicate_payment_events(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 50_000, 'raised_cents' => 0, 'is_active' => true]);

        $donation = Donation::factory()->create([
            'gift_id' => $gift->id,
            'amount_cents' => 10_000,
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => 'pay_dup',
        ]);

        $payload = [
            'event' => 'PAYMENT_RECEIVED',
            'payment' => ['id' => 'pay_dup', 'status' => 'RECEIVED'],
        ];

        $this->postJson('/api/asaas-webhook', $payload)->assertOk();
        $this->postJson('/api/asaas-webhook', $payload)->assertOk();

        $this->assertSame(10_000, $gift->fresh()->raised_cents);
        $this->assertSame(Donation::STATUS_PAID, $donation->fresh()->status);
    }

    public function test_webhook_refund_reverts_gift_raised_total(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 50_000, 'raised_cents' => 0, 'is_active' => true]);

        $donation = Donation::factory()->create([
            'gift_id' => $gift->id,
            'amount_cents' => 10_000,
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => 'pay_ref',
        ]);

        $this->postJson('/api/asaas-webhook', [
            'event' => 'PAYMENT_RECEIVED',
            'payment' => ['id' => 'pay_ref', 'status' => 'RECEIVED'],
        ])->assertOk();

        $this->assertSame(10_000, $gift->fresh()->raised_cents);

        $this->postJson('/api/asaas-webhook', [
            'event' => 'PAYMENT_REFUNDED',
            'payment' => ['id' => 'pay_ref', 'status' => 'REFUNDED'],
        ])->assertOk();

        $this->assertSame(0, $gift->fresh()->raised_cents);
        $this->assertSame(Donation::STATUS_REFUNDED, $donation->fresh()->status);
    }

    public function test_webhook_without_payment_id_is_ignored(): void
    {
        $this->postJson('/api/asaas-webhook', ['event' => 'PING'])->assertOk();
    }

    public function test_status_check_polls_asaas_and_redirects_when_paid(): void
    {
        config()->set('wedding.asaas.api_key', 'test-key');

        $gift = Gift::factory()->create(['price_cents' => 50_000, 'raised_cents' => 0, 'is_active' => true]);

        $donation = Donation::factory()->create([
            'gift_id' => $gift->id,
            'amount_cents' => 10_000,
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => 'pay_poll',
        ]);

        Http::fake([
            'api-sandbox.asaas.com/v3/payments/pay_poll' => Http::response([
                'id' => 'pay_poll',
                'status' => 'RECEIVED',
            ]),
        ]);

        $response = $this->get(route('donation.status', $donation));

        $response->assertRedirect(route('donation.confirmation', ['donation' => $donation]));
        $this->assertSame(Donation::STATUS_PAID, $donation->fresh()->status);
        $this->assertSame(10_000, $gift->fresh()->raised_cents);
    }

    public function test_status_check_keeps_pending_when_asaas_still_pending(): void
    {
        config()->set('wedding.asaas.api_key', 'test-key');

        $donation = Donation::factory()->create([
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => 'pay_wait',
        ]);

        Http::fake([
            'api-sandbox.asaas.com/v3/payments/pay_wait' => Http::response([
                'id' => 'pay_wait',
                'status' => 'PENDING',
            ]),
        ]);

        $this->get(route('donation.status', $donation))->assertOk();
        $this->assertSame(Donation::STATUS_PENDING, $donation->fresh()->status);
    }

    public function test_status_check_survives_asaas_outage(): void
    {
        config()->set('wedding.asaas.api_key', 'test-key');

        $donation = Donation::factory()->create([
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => 'pay_down',
        ]);

        Http::fake([
            'api-sandbox.asaas.com/*' => Http::response('error', 500),
        ]);

        $this->get(route('donation.status', $donation))->assertOk();
        $this->assertSame(Donation::STATUS_PENDING, $donation->fresh()->status);
    }
}
