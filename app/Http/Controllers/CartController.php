<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public const SESSION_KEY = 'wedding_cart';

    public function add(Gift $gift, Request $request): RedirectResponse
    {
        abort_unless($gift->is_active, 404);

        $cart = $this->cart();
        $cart[$gift->id] = ($cart[$gift->id] ?? 0) + 1;
        Session::put(self::SESSION_KEY, $cart);

        return back()->with('cart.added', $gift->name);
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
     * @return array<int, int>
     */
    protected function cart(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }
}
