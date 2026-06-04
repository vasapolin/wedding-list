<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\SiteAsset;
use App\Rules\CpfOuCnpj;
use App\Services\AsaasClient;
use App\Services\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    public function direct(): View
    {
        return view('donation.direct');
    }

    public function checkout(Cart $cart): View
    {
        return view('donation.checkout', [
            'cart' => $cart,
        ]);
    }

    public function store(Request $request, Cart $cart, AsaasClient $asaas): RedirectResponse
    {
        $isDirect = $request->routeIs('donation.store') && ! $request->filled('use_cart');
        $useCart = $request->boolean('use_cart');

        $rules = [
            'donor_name' => ['nullable', 'string', 'max:120'],
            'donor_email' => ['required', 'email', 'max:191'],
            'donor_document' => ['required', 'string', new CpfOuCnpj],
            'message' => ['nullable', 'string', 'max:1000'],
            'is_anonymous' => ['nullable', 'boolean'],
            'payment_method' => ['required', 'in:pix,credit_card'],
        ];

        if (! $useCart) {
            $rules['amount'] = ['required', 'numeric', 'min:1'];
            $rules['gift_id'] = ['nullable', 'exists:gifts,id'];
        }

        $data = Validator::make($request->all(), $rules)->validate();

        $amountCents = $useCart
            ? $cart->totalCents()
            : (int) round(((float) $data['amount']) * 100);

        if ($amountCents <= 0) {
            return back()->withErrors(['amount' => 'Valor inválido para a doação.']);
        }

        $donation = Donation::query()->create([
            'gift_id' => $useCart ? null : ($data['gift_id'] ?? null),
            'donor_name' => $data['donor_name'] ?? null,
            'donor_email' => $data['donor_email'],
            'donor_document' => preg_replace('/\D/', '', $data['donor_document']),
            'amount_cents' => $amountCents,
            'message' => $data['message'] ?? null,
            'is_anonymous' => (bool) ($data['is_anonymous'] ?? false),
            'payment_method' => $data['payment_method'],
            'status' => Donation::STATUS_PENDING,
        ]);

        try {
            $asaas->createCharge($donation);
        } catch (\Throwable $e) {
            report($e);
        }

        if ($useCart) {
            Session::forget(\App\Http\Controllers\CartController::SESSION_KEY);
        }

        if ($donation->payment_method === 'credit_card' && ($invoiceUrl = $asaas->getInvoiceUrl($donation))) {
            return redirect()->away($invoiceUrl);
        }

        return redirect()->route('donation.pix', ['donation' => $donation]);
    }

    public function pix(Donation $donation, AsaasClient $asaas): RedirectResponse|View
    {
        if ($donation->status === Donation::STATUS_PENDING && ! $donation->asaas_payment_id) {
            try {
                $asaas->createCharge($donation);
                $donation->refresh();
            } catch (\Throwable $e) {
                report($e);
            }
        }

        if ($donation->payment_method === 'credit_card'
            && $donation->status === Donation::STATUS_PENDING
            && ($invoiceUrl = $asaas->getInvoiceUrl($donation))) {
            return redirect()->away($invoiceUrl);
        }

        return view('donation.pix', [
            'donation' => $donation,
            'pix' => $asaas->getPixData($donation),
        ]);
    }

    public function status(Donation $donation): RedirectResponse|View
    {
        if ($donation->status === Donation::STATUS_PAID) {
            return redirect()->route('donation.confirmation', ['donation' => $donation]);
        }

        return view('donation.pix', [
            'donation' => $donation,
            'pix' => app(AsaasClient::class)->getPixData($donation),
        ]);
    }

    public function confirmation(Donation $donation): View
    {
        return view('donation.confirmation', [
            'donation' => $donation,
            'heroUrl' => SiteAsset::url('confirmation.hero'),
        ]);
    }
}
