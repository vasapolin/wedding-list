<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->string('filter')->value();

        $gifts = Gift::query()
            ->where('is_active', true)
            ->when($filter === 'cem', fn ($q) => $q->where('price_cents', '<=', 10_000))
            ->when($filter === 'medio', fn ($q) => $q->whereBetween('price_cents', [10_001, 50_000]))
            ->when($filter === 'premium', fn ($q) => $q->where('price_cents', '>', 50_000))
            ->when($filter === 'lua', fn ($q) => $q->where('category', 'lua-de-mel'))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('gifts.index', [
            'gifts' => $gifts,
            'activeFilter' => $filter ?: 'todos',
        ]);
    }
}
