<?php

namespace Tests\Feature;

use App\Models\SiteAsset;
use Database\Seeders\SiteAssetSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteAssetSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_points_site_assets_to_local_prewedding_images(): void
    {
        $this->seed(SiteAssetSeeder::class);

        $expected = [
            'home.hero' => '/images/site/home-hero.webp',
            'home.hero.mobile' => '/images/site/home-hero-mobile.webp',
            'messages.hero' => '/images/site/messages-hero.webp',
            'how-to-donate.hero' => '/images/site/how-to-donate-hero.webp',
            'how-to-donate.detail' => '/images/site/how-to-donate-detail.webp',
            'how-to-donate.flexible' => '/images/site/how-to-donate-flexible.webp',
            'confirmation.hero' => '/images/site/confirmation-hero.webp',
        ];

        foreach ($expected as $key => $fallbackUrl) {
            $this->assertSame(
                $fallbackUrl,
                SiteAsset::query()->where('key', $key)->value('fallback_url'),
                "Asset [{$key}] should fall back to the local prewedding image.",
            );
        }
    }

    public function test_seeded_local_images_exist_in_public_directory(): void
    {
        $this->seed(SiteAssetSeeder::class);

        SiteAsset::query()
            ->where('fallback_url', 'like', '/images/site/%')
            ->each(function (SiteAsset $asset): void {
                $this->assertFileExists(
                    public_path(ltrim($asset->fallback_url, '/')),
                    "Fallback file for [{$asset->key}] is missing from public/.",
                );
            });
    }

    public function test_seeder_updates_existing_fallback_url_but_preserves_admin_upload(): void
    {
        SiteAsset::query()->create([
            'key' => 'home.hero',
            'label' => 'Home — Hero (fundo)',
            'image_path' => 'site/custom-upload.jpg',
            'fallback_url' => 'https://images.unsplash.com/old-stock-photo.jpg',
        ]);

        $this->seed(SiteAssetSeeder::class);

        $asset = SiteAsset::query()->where('key', 'home.hero')->firstOrFail();

        $this->assertSame('/images/site/home-hero.webp', $asset->fallback_url);
        $this->assertSame('site/custom-upload.jpg', $asset->image_path);
    }

    public function test_gifts_placeholder_keeps_generic_fallback(): void
    {
        $this->seed(SiteAssetSeeder::class);

        $this->assertStringStartsWith(
            'https://',
            SiteAsset::query()->where('key', 'gifts.placeholder')->value('fallback_url'),
        );
    }
}
