<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Services\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Versioned because the cart shape changed from quantities to per-gift
     * contribution amounts; carts left over from the old shape are dropped.
     */
    public const SESSION_KEY = 'wedding_cart_v2';

    public function add(Gift $gift, Request $request): RedirectResponse
    {
        abort_unless($gift->is_active && ! $gift->isFullyFunded(), 404);

        $amountCents = $this->validatedAmountCents($gift, $request);

        $cart = $this->cart();
        $cart[$gift->id] = $amountCents;
        Session::put(self::SESSION_KEY, $cart);

        return back()->with('cart.added', $gift->name);
    }

    public function update(Gift $gift, Request $request): RedirectResponse
    {
        abort_unless($gift->is_active && ! $gift->isFullyFunded(), 404);

        $cart = $this->cart();
        abort_unless(isset($cart[$gift->id]), 404);

        $cart[$gift->id] = $this->validatedAmountCents($gift, $request);
        Session::put(self::SESSION_KEY, $cart);

        return back();
    }

    public function remove(Gift $gift): RedirectResponse
    {
        $cart = $this->cart();
        unset($cart[$gift->id]);
        Session::put(self::SESSION_KEY, $cart);

        return back();
    }

    public function clear(): RedirectResponse
    {
        Session::forget(self::SESSION_KEY);

        return back();
    }

    /**
     * Contribution for this gift in cents, defaulting to whatever the gift
     * still needs when the guest does not name an amount.
     */
    protected function validatedAmountCents(Gift $gift, Request $request): int
    {
        if (! $request->filled('amount')) {
            return $gift->remaining_cents;
        }

        $minimum = min(Cart::MIN_CONTRIBUTION_CENTS, $gift->remaining_cents) / 100;

        $data = $request->validate([
            'amount' => ['numeric', 'min:'.$minimum, 'max:'.($gift->remaining_cents / 100)],
        ], [
            'amount.min' => 'O valor mínimo para contribuir é R$ '.number_format($minimum, 2, ',', '.').'.',
            'amount.max' => 'Falta apenas R$ '.number_format($gift->remaining_cents / 100, 2, ',', '.').' para completar este presente.',
        ]);

        return (int) round(((float) $data['amount']) * 100);
    }

    /**
     * @return array<int, int>
     */
    protected function cart(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }
}
