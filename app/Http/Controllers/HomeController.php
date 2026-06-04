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
            'galleryUrls' => [
                SiteAsset::url('home.gallery.1'),
                SiteAsset::url('home.gallery.2'),
                SiteAsset::url('home.gallery.3'),
                SiteAsset::url('home.gallery.4'),
            ],
        ]);
    }
}
