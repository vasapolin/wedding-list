<?php

use App\Models\SiteAsset;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * The local site images were converted from JPG to WebP and the JPG files
     * were removed from the repository. Production rows still point at the
     * deleted files — and the seeder only runs on a fresh volume — so repoint
     * the known fallbacks here. Admin uploads (image_path) take precedence
     * over fallback_url and are left untouched.
     *
     * @var array<string, string>
     */
    private const CONVERTED_IMAGES = [
        '/images/site/home-hero.jpg' => '/images/site/home-hero.webp',
        '/images/site/home-hero-mobile.jpg' => '/images/site/home-hero-mobile.webp',
        '/images/site/messages-hero.jpg' => '/images/site/messages-hero.webp',
        '/images/site/how-to-donate-hero.jpg' => '/images/site/how-to-donate-hero.webp',
        '/images/site/how-to-donate-detail.jpg' => '/images/site/how-to-donate-detail.webp',
        '/images/site/how-to-donate-flexible.jpg' => '/images/site/how-to-donate-flexible.webp',
        '/images/site/confirmation-hero.jpg' => '/images/site/confirmation-hero.webp',
    ];

    public function up(): void
    {
        foreach (self::CONVERTED_IMAGES as $jpg => $webp) {
            SiteAsset::query()
                ->where('fallback_url', $jpg)
                ->update(['fallback_url' => $webp]);
        }
    }

    public function down(): void
    {
        foreach (self::CONVERTED_IMAGES as $jpg => $webp) {
            SiteAsset::query()
                ->where('fallback_url', $webp)
                ->update(['fallback_url' => $jpg]);
        }
    }
};
