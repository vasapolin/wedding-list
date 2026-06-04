<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Gift;
use App\Services\AsaasClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PaymentHardeningTest extends TestCase
{
    use RefreshDatabase;

    public function test_stale_model_instances_cannot_double_increment_raised(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 50_000, 'raised_cents' => 0, 'is_active' => true]);

        $donation = Donation::factory()->create([
            'gift_id' => $gift->id,
            'amount_cents' => 10_000,
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => 'pay_race',
        ]);

        $staleA = Donation::query()->find($donation->id);
        $staleB = Donation::query()->find($donation->id);

        $client = app(AsaasClient::class);
        $client->applyChargeStatus($staleA, ['id' => 'pay_race', 'status' => 'RECEIVED']);
        $client->applyChargeStatus($staleB, ['id' => 'pay_race', 'status' => 'RECEIVED']);

        $this->assertSame(10_000, $gift->fresh()->raised_cents);
    }

    public function test_paid_donation_is_not_downgraded_by_unknown_status(): void
    {
        $donation = Donation::factory()->create([
            'status' => Donation::STATUS_PAID,
            'paid_at' => now(),
            'asaas_payment_id' => 'pay_keep',
        ]);

        app(AsaasClient::class)->applyChargeStatus($donation, [
            'id' => 'pay_keep',
            'status' => 'AWAITING_RISK_ANALYSIS',
        ]);

        $this->assertSame(Donation::STATUS_PAID, $donation->fresh()->status);
    }

    public function test_webhook_verifies_status_with_asaas_instead_of_trusting_payload(): void
    {
        config()->set('wedding.asaas.api_key', 'test-key');

        $donation = Donation::factory()->create([
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => 'pay_spoof',
        ]);

        Http::fake([
            'api-sandbox.asaas.com/v3/payments/pay_spoof' => Http::response([
                'id' => 'pay_spoof',
                'status' => 'PENDING',
            ]),
        ]);

        $this->postJson('/api/asaas-webhook', [
            'event' => 'PAYMENT_RECEIVED',
            'payment' => ['id' => 'pay_spoof', 'status' => 'RECEIVED'],
        ])->assertOk();

        $this->assertSame(Donation::STATUS_PENDING, $donation->fresh()->status);
        Http::assertSent(fn ($request) => str_ends_with($request->url(), '/payments/pay_spoof'));
    }

    public function test_webhook_confirms_payment_after_real_asaas_check(): void
    {
        config()->set('wedding.asaas.api_key', 'test-key');

        $gift = Gift::factory()->create(['price_cents' => 50_000, 'raised_cents' => 0, 'is_active' => true]);
        $donation = Donation::factory()->create([
            'gift_id' => $gift->id,
            'amount_cents' => 10_000,
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => 'pay_real',
        ]);

        Http::fake([
            'api-sandbox.asaas.com/v3/payments/pay_real' => Http::response([
                'id' => 'pay_real',
                'status' => 'RECEIVED',
            ]),
        ]);

        $this->postJson('/api/asaas-webhook', [
            'event' => 'PAYMENT_RECEIVED',
            'payment' => ['id' => 'pay_real', 'status' => 'RECEIVED'],
        ])->assertOk();

        $this->assertSame(Donation::STATUS_PAID, $donation->fresh()->status);
        $this->assertSame(10_000, $gift->fresh()->raised_cents);
    }

    public function test_webhook_finds_donation_by_external_reference_when_payment_id_missing(): void
    {
        $donation = Donation::factory()->create([
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => null,
        ]);

        $this->postJson('/api/asaas-webhook', [
            'event' => 'PAYMENT_RECEIVED',
            'payment' => [
                'id' => 'pay_orphan',
                'status' => 'RECEIVED',
                'externalReference' => 'donation-'.$donation->id,
            ],
        ])->assertOk();

        $donation->refresh();
        $this->assertSame('pay_orphan', $donation->asaas_payment_id);
        $this->assertSame(Donation::STATUS_PAID, $donation->status);
    }

    public function test_payment_id_is_persisted_even_when_qr_fetch_fails(): void
    {
        config()->set('wedding.asaas.api_key', 'test-key');

        Http::fake([
            'api-sandbox.asaas.com/v3/customers*' => Http::sequence()
                ->push(['data' => []])
                ->push(['id' => 'cus_1']),
            'api-sandbox.asaas.com/v3/payments' => Http::response([
                'id' => 'pay_noqr',
                'status' => 'PENDING',
                'invoiceUrl' => 'https://sandbox.asaas.com/i/pay_noqr',
            ]),
            'api-sandbox.asaas.com/v3/payments/pay_noqr/pixQrCode' => Http::response('error', 500),
        ]);

        $this->post('/checkout', [
            'amount' => 100,
            'donor_email' => 'tio@example.com',
            'donor_document' => '52998224725',
            'payment_method' => 'pix',
        ]);

        $donation = Donation::query()->latest()->first();
        $this->assertSame('pay_noqr', $donation->asaas_payment_id);
        $this->assertArrayNotHasKey('qr', $donation->asaas_payload ?? []);
    }

    public function test_pix_page_refetches_missing_qr_code(): void
    {
        config()->set('wedding.asaas.api_key', 'test-key');

        $donation = Donation::factory()->create([
            'status' => Donation::STATUS_PENDING,
            'payment_method' => 'pix',
            'asaas_payment_id' => 'pay_refetch',
            'asaas_payload' => ['charge' => ['id' => 'pay_refetch']],
        ]);

        Http::fake([
            'api-sandbox.asaas.com/v3/payments/pay_refetch/pixQrCode' => Http::response([
                'payload' => 'pix-copy-paste-recovered',
                'encodedImage' => base64_encode('img'),
                'expirationDate' => now()->addDay()->toDateTimeString(),
            ]),
        ]);

        $response = $this->get(route('donation.pix', $donation));

        $response->assertOk()->assertSee('pix-copy-paste-recovered');
        $this->assertSame('pix-copy-paste-recovered', $donation->fresh()->asaas_payload['qr']['payload']);
    }

    public function test_status_check_retries_charge_creation_when_payment_id_missing(): void
    {
        config()->set('wedding.asaas.api_key', 'test-key');

        $donation = Donation::factory()->create([
            'status' => Donation::STATUS_PENDING,
            'payment_method' => 'pix',
            'asaas_payment_id' => null,
        ]);

        Http::fake([
            'api-sandbox.asaas.com/v3/customers*' => Http::sequence()
                ->push(['data' => []])
                ->push(['id' => 'cus_1']),
            'api-sandbox.asaas.com/v3/payments' => Http::response([
                'id' => 'pay_lazy',
                'status' => 'PENDING',
            ]),
            'api-sandbox.asaas.com/v3/payments/pay_lazy/pixQrCode' => Http::response([
                'payload' => 'pix-lazy',
                'encodedImage' => base64_encode('img'),
                'expirationDate' => now()->addDay()->toDateTimeString(),
            ]),
        ]);

        $this->get(route('donation.status', $donation))->assertOk();

        $this->assertSame('pay_lazy', $donation->fresh()->asaas_payment_id);
    }

    public function test_sync_status_ignores_payment_missing_in_asaas(): void
    {
        config()->set('wedding.asaas.api_key', 'test-key');

        $donation = Donation::factory()->create([
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => 'pay_gone',
        ]);

        Http::fake([
            'api-sandbox.asaas.com/v3/payments/pay_gone' => Http::response(['errors' => []], 404),
        ]);

        app(AsaasClient::class)->syncStatus('pay_gone');

        $this->assertSame(Donation::STATUS_PENDING, $donation->fresh()->status);
    }
}
