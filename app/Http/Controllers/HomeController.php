<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\SiteAsset;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredGifts = Gift::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('home', [
            'featuredGifts' => $featuredGifts,
            'heroUrl' => SiteAsset::url('home.hero'),
            'heroMobileUrl' => SiteAsset::url('home.hero.mobile'),
        ]);
    }
}
