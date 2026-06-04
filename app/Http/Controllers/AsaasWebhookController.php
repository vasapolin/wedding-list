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

        $donation = Donation::query()->where('asaas_payment_id', $asaasId)->first();
        if ($donation) {
            $asaas->applyChargeStatus($donation, $charge);
        }

        return response()->json(['ok' => true]);
    }
}
