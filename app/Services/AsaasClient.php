<?php

namespace App\Services;

use App\Models\Donation;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class AsaasClient
{
    public function __construct()
    {
        //
    }

    public function isEnabled(): bool
    {
        return ! empty(config('wedding.asaas.api_key'));
    }

    /**
     * Create a Pix charge in Asaas and persist QR Code data on the donation.
     *
     * If no API key is configured, this no-ops gracefully so the local /
     * dev environment still works (the donation just stays as pending).
     */
    public function createPixCharge(Donation $donation): void
    {
        if (! $this->isEnabled()) {
            return;
        }

        $customerId = $this->ensureCustomer($donation);

        $charge = $this->client()->post('/payments', [
            'customer' => $customerId,
            'billingType' => 'PIX',
            'value' => round($donation->amount_cents / 100, 2),
            'dueDate' => now()->addDay()->toDateString(),
            'description' => $this->descriptionFor($donation),
            'externalReference' => 'donation-'.$donation->id,
        ])->throw()->json();

        $qr = $this->client()->get("/payments/{$charge['id']}/pixQrCode")->throw()->json();

        $payload = [
            'charge' => $charge,
            'qr' => $qr,
        ];

        $donation->update([
            'asaas_payment_id' => $charge['id'],
            'asaas_payload' => array_merge($donation->asaas_payload ?? [], $payload),
        ]);
    }

    /**
     * @return array{copy_paste: ?string, qr_code_image: ?string, expires_at: ?string}
     */
    public function getPixData(Donation $donation): array
    {
        $payload = $donation->asaas_payload ?? [];
        $qr = $payload['qr'] ?? [];

        return [
            'copy_paste' => $qr['payload'] ?? null,
            'qr_code_image' => isset($qr['encodedImage'])
                ? 'data:image/png;base64,'.$qr['encodedImage']
                : null,
            'expires_at' => $qr['expirationDate'] ?? null,
        ];
    }

    public function syncStatus(string $asaasPaymentId): void
    {
        if (! $this->isEnabled()) {
            return;
        }

        $donation = Donation::query()->where('asaas_payment_id', $asaasPaymentId)->first();
        if (! $donation) {
            return;
        }

        $charge = $this->client()->get("/payments/{$asaasPaymentId}")->throw()->json();
        $this->applyChargeStatus($donation, $charge);
    }

    public function applyChargeStatus(Donation $donation, array $charge): void
    {
        $status = match ($charge['status'] ?? null) {
            'CONFIRMED', 'RECEIVED', 'RECEIVED_IN_CASH' => Donation::STATUS_PAID,
            'OVERDUE', 'REFUSED', 'CANCELLED' => Donation::STATUS_FAILED,
            'REFUNDED', 'CHARGEBACK_REQUESTED', 'CHARGEBACK_DISPUTE' => Donation::STATUS_REFUNDED,
            default => Donation::STATUS_PENDING,
        };

        $previousStatus = $donation->status;

        $donation->update([
            'status' => $status,
            'paid_at' => $status === Donation::STATUS_PAID && ! $donation->paid_at ? now() : $donation->paid_at,
            'asaas_payload' => array_merge($donation->asaas_payload ?? [], ['last_charge' => $charge]),
        ]);

        if ($status === Donation::STATUS_PAID && $previousStatus !== Donation::STATUS_PAID && $donation->gift_id) {
            $donation->gift()->increment('raised_cents', $donation->amount_cents);
        }
    }

    protected function ensureCustomer(Donation $donation): string
    {
        $payload = $donation->asaas_payload ?? [];
        if (! empty($payload['customer_id'])) {
            return $payload['customer_id'];
        }

        $email = $donation->donor_email ?: 'doador-'.$donation->id.'@example.com';

        $existing = $this->client()->get('/customers', array_filter([
            'email' => $email,
            'cpfCnpj' => $donation->donor_document,
        ]))->throw()->json();
        $customerId = $existing['data'][0]['id'] ?? null;

        if (! $customerId) {
            $customer = $this->client()->post('/customers', array_filter([
                'name' => $donation->donor_name ?: 'Doador anônimo',
                'email' => $email,
                'cpfCnpj' => $donation->donor_document,
            ]))->throw()->json();
            $customerId = $customer['id'];
        }

        $donation->update([
            'asaas_payload' => array_merge($payload, ['customer_id' => $customerId]),
        ]);

        return $customerId;
    }

    protected function descriptionFor(Donation $donation): string
    {
        if ($donation->gift_id && $donation->gift) {
            return 'Casamento Laura & Victor — '.$donation->gift->name;
        }

        return 'Casamento Laura & Victor — Doação direta';
    }

    protected function client(): PendingRequest
    {
        $base = config('wedding.asaas.environment') === 'production'
            ? 'https://api.asaas.com/v3'
            : 'https://api-sandbox.asaas.com/v3';

        return Http::baseUrl($base)
            ->withHeaders([
                'access_token' => config('wedding.asaas.api_key'),
                'Accept' => 'application/json',
            ])
            ->acceptJson()
            ->timeout(15);
    }
}
