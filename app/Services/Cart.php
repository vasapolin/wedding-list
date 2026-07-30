<?php

namespace App\Services;

use App\Http\Controllers\CartController;
use App\Models\Gift;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class Cart
{
    /**
     * Smallest contribution accepted for a single gift, in cents. Matches the
     * minimum Asaas accepts for a charge.
     */
    public const MIN_CONTRIBUTION_CENTS = 500;

    /**
     * Contributions currently in the cart, one line per gift.
     *
     * Amounts are clamped against what each gift still needs, so a gift that
     * got funded by someone else while this cart sat in the session shrinks —
     * or drops out entirely — instead of overshooting at checkout.
     *
     * @return Collection<int, array{gift: Gift, amount_cents: int}>
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
            ->filter(fn ($amountCents, $id) => isset($gifts[$id]) && ! $gifts[$id]->isFullyFunded())
            ->map(fn (int $amountCents, int $id) => [
                'gift' => $gifts[$id],
                'amount_cents' => min($amountCents, $gifts[$id]->remaining_cents),
            ])
            ->values();
    }

    public function totalCents(): int
    {
        return (int) $this->items()->sum('amount_cents');
    }

    public function count(): int
    {
        return $this->items()->count();
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }
}
