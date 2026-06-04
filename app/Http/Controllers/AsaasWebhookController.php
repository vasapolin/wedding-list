<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Services\AsaasClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AsaasWebhookController extends Controller
{
    public function handle(Request $request, AsaasClient $asaas): JsonResponse
    {
        $expectedToken = config('wedding.asaas.webhook_token');
        if ($expectedToken && $request->header('asaas-access-token') !== $expectedToken) {
            return response()->json(['error' => 'invalid token'], 401);
        }

        $charge = $request->input('payment') ?? $request->input('charge') ?? [];
        $asaasId = $charge['id'] ?? null;

        if (! $asaasId) {
            return response()->json(['ok' => true]);
        }

        $donation = Donation::query()->where('asaas_payment_id', $asaasId)->first()
            ?? $this->findByExternalReference($charge);

        if ($donation) {
            if (! $donation->asaas_payment_id) {
                $donation->update(['asaas_payment_id' => $asaasId]);
            }

            if ($asaas->isEnabled()) {
                $asaas->syncStatus($asaasId);
            } else {
                $asaas->applyChargeStatus($donation, $charge);
            }
        }

        return response()->json(['ok' => true]);
    }

    /**
     * Charges are created with externalReference "donation-{id}", so a
     * webhook can still be matched when the charge was created in Asaas but
     * the payment id was never persisted locally (e.g. a timeout after the
     * POST, or the webhook racing the redirect).
     */
    protected function findByExternalReference(array $charge): ?Donation
    {
        $reference = (string) ($charge['externalReference'] ?? '');

        if (! preg_match('/^donation-(\d+)$/', $reference, $matches)) {
            return null;
        }

        return Donation::query()
            ->whereNull('asaas_payment_id')
            ->find((int) $matches[1]);
    }
}
