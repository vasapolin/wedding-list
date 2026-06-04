<?php

namespace App\Services;

use App\Http\Controllers\CartController;
use App\Models\Gift;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class Cart
{
    /**
     * @return Collection<int, array{gift: Gift, quantity: int, line_cents: int}>
     */
    public function items(): Collection
    {
        $cart = Session::get(CartController::SESSION_KEY, []);
        if (empty($cart)) {
            return collect();
        }

        $gifts = Gift::query()
            ->whereIn('id', array_keys($cart))
            ->where('is_active', true)
            ->get()
            ->keyBy('id');

        return collect($cart)
            ->filter(fn ($qty, $id) => isset($gifts[$id]))
            ->map(fn (int $qty, int $id) => [
                'gift' => $gifts[$id],
                'quantity' => $qty,
                'line_cents' => $gifts[$id]->price_cents * $qty,
            ])
            ->values();
    }

    public function totalCents(): int
    {
        return (int) $this->items()->sum('line_cents');
    }

    public function count(): int
    {
        return (int) $this->items()->sum('quantity');
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }
}
