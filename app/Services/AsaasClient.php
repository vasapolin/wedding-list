<?php

namespace App\Services;

use App\Models\Donation;
use App\Models\DonationItem;
use App\Models\Gift;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\DB;
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
     * Create a charge in Asaas (Pix or credit card) and persist its data on
     * the donation. Pix charges also fetch and store the QR Code payload.
     *
     * If no API key is configured, this no-ops gracefully so the local /
     * dev environment still works (the donation just stays as pending).
     */
    public function createCharge(Donation $donation): void
    {
        if (! $this->isEnabled()) {
            return;
        }

        $isCreditCard = $donation->payment_method === 'credit_card';
        $customerId = $this->ensureCustomer($donation);

        $chargePayload = [
            'customer' => $customerId,
            'billingType' => $isCreditCard ? 'CREDIT_CARD' : 'PIX',
            'value' => round($donation->amount_cents / 100, 2),
            'dueDate' => now()->addDay()->toDateString(),
            'description' => $this->descriptionFor($donation),
            'externalReference' => 'donation-'.$donation->id,
            'callback' => [
                'successUrl' => route('donation.status', $donation),
                'autoRedirect' => true,
            ],
        ];

        $response = $this->client()->post('/payments', $chargePayload);

        if ($response->status() === 400 && $this->isCallbackDomainError($response)) {
            unset($chargePayload['callback']);
            $response = $this->client()->post('/payments', $chargePayload);
        }

        $charge = $response->throw()->json();

        $donation->update([
            'asaas_payment_id' => $charge['id'],
            'asaas_payload' => array_merge($donation->asaas_payload ?? [], ['charge' => $charge]),
        ]);

        if (! $isCreditCard) {
            try {
                $this->fetchPixQrCode($donation);
            } catch (\Throwable $e) {
                report($e);
            }
        }
    }

    /**
     * Fetch (or re-fetch) the Pix QR Code for an already-created charge.
     * Kept separate from charge creation so a transient failure here never
     * loses the asaas_payment_id of a charge that already exists in Asaas.
     */
    public function fetchPixQrCode(Donation $donation): void
    {
        if (! $this->isEnabled() || ! $donation->asaas_payment_id) {
            return;
        }

        $qr = $this->client()
            ->get("/payments/{$donation->asaas_payment_id}/pixQrCode")
            ->throw()
            ->json();

        $donation->update([
            'asaas_payload' => array_merge($donation->asaas_payload ?? [], ['qr' => $qr]),
        ]);
    }

    /**
     * Asaas-hosted secure payment page for the charge (used for credit card).
     */
    public function getInvoiceUrl(Donation $donation): ?string
    {
        return $donation->asaas_payload['charge']['invoiceUrl'] ?? null;
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

        $response = $this->client()->get("/payments/{$asaasPaymentId}");

        if ($response->status() === 404) {
            return;
        }

        $this->applyChargeStatus($donation, $response->throw()->json());
    }

    public function applyChargeStatus(Donation $donation, array $charge): void
    {
        $status = match ($charge['status'] ?? null) {
            'CONFIRMED', 'RECEIVED', 'RECEIVED_IN_CASH' => Donation::STATUS_PAID,
            'OVERDUE', 'REFUSED', 'CANCELLED' => Donation::STATUS_FAILED,
            'REFUNDED', 'CHARGEBACK_REQUESTED', 'CHARGEBACK_DISPUTE' => Donation::STATUS_REFUNDED,
            default => Donation::STATUS_PENDING,
        };

        DB::transaction(function () use ($donation, $charge, $status): void {
            $locked = Donation::query()->whereKey($donation->getKey())->lockForUpdate()->first();

            if (! $locked) {
                return;
            }

            $previousStatus = $locked->status;

            if ($previousStatus === Donation::STATUS_PAID && $status === Donation::STATUS_PENDING) {
                return;
            }

            $locked->update([
                'status' => $status,
                'paid_at' => $status === Donation::STATUS_PAID && ! $locked->paid_at ? now() : $locked->paid_at,
                'asaas_payload' => array_merge($locked->asaas_payload ?? [], ['last_charge' => $charge]),
            ]);

            $contributions = $this->contributionsFor($locked);

            if ($status === Donation::STATUS_PAID && $previousStatus !== Donation::STATUS_PAID) {
                foreach ($contributions as [$giftId, $amountCents]) {
                    Gift::query()->whereKey($giftId)->increment('raised_cents', $amountCents);
                }
            }

            if ($status === Donation::STATUS_REFUNDED && $previousStatus === Donation::STATUS_PAID) {
                foreach ($contributions as [$giftId, $amountCents]) {
                    Gift::query()->whereKey($giftId)->decrement('raised_cents', $amountCents);
                }
            }
        });

        $donation->refresh();
    }

    /**
     * Which gifts this donation credits, and by how much. A donation spread
     * across several gifts carries one item per gift; donations created before
     * items existed fall back to their single `gift_id`.
     *
     * @return array<int, array{0: int, 1: int}>
     */
    protected function contributionsFor(Donation $donation): array
    {
        $items = $donation->items()->get();

        if ($items->isNotEmpty()) {
            return $items
                ->map(fn (DonationItem $item): array => [$item->gift_id, $item->amount_cents])
                ->all();
        }

        return $donation->gift_id ? [[$donation->gift_id, $donation->amount_cents]] : [];
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

    /**
     * Asaas rejects payment callbacks when the account has no registered
     * site domain; in that case the charge is retried without the callback
     * so payments keep working (the donor just is not auto-redirected back).
     */
    protected function isCallbackDomainError(Response $response): bool
    {
        $descriptions = collect($response->json('errors') ?? [])
            ->pluck('description')
            ->implode(' ');

        $normalized = mb_strtolower($descriptions);

        return str_contains($normalized, 'callback')
            || str_contains($normalized, 'domínio')
            || str_contains($normalized, 'dominio');
    }

    protected function descriptionFor(Donation $donation): string
    {
        $prefix = 'Casamento Laura & Victor — ';

        $items = $donation->items()->with('gift')->get();

        if ($items->isNotEmpty()) {
            $names = $items->map(fn (DonationItem $item): ?string => $item->gift?->name)->filter();

            if ($names->count() === 1) {
                return $prefix.$names->first();
            }

            if ($names->isNotEmpty()) {
                return $prefix.'Contribuição para '.$names->count().' presentes';
            }
        }

        if ($donation->gift_id && $donation->gift) {
            return $prefix.$donation->gift->name;
        }

        return $prefix.'Doação direta';
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
