<?php

namespace Tests\Feature;

use App\Models\SiteAsset;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteAssetWebpMigrationTest extends TestCase
{
    use RefreshDatabase;

    private function migration(): Migration
    {
        $matches = glob(database_path('migrations/*_point_site_asset_fallbacks_to_webp.php'));

        $this->assertNotEmpty($matches, 'A migration que reaponta os fallbacks para .webp não foi encontrada.');

        return require $matches[0];
    }

    public function test_legacy_jpg_fallbacks_are_repointed_to_webp(): void
    {
        $legacy = [
            'home.hero' => '/images/site/home-hero.jpg',
            'home.hero.mobile' => '/images/site/home-hero-mobile.jpg',
            'messages.hero' => '/images/site/messages-hero.jpg',
            'how-to-donate.hero' => '/images/site/how-to-donate-hero.jpg',
            'how-to-donate.detail' => '/images/site/how-to-donate-detail.jpg',
            'how-to-donate.flexible' => '/images/site/how-to-donate-flexible.jpg',
            'confirmation.hero' => '/images/site/confirmation-hero.jpg',
        ];

        foreach ($legacy as $key => $fallbackUrl) {
            SiteAsset::query()->create([
                'key' => $key,
                'label' => $key,
                'fallback_url' => $fallbackUrl,
            ]);
        }

        $this->migration()->up();

        foreach ($legacy as $key => $fallbackUrl) {
            $current = SiteAsset::query()->where('key', $key)->value('fallback_url');

            $this->assertSame(
                str_replace('.jpg', '.webp', $fallbackUrl),
                $current,
                "O fallback de [{$key}] deveria apontar para o arquivo .webp.",
            );

            $this->assertFileExists(
                public_path(ltrim($current, '/')),
                "O arquivo .webp de [{$key}] não existe em public/.",
            );
        }
    }

    public function test_migration_preserves_admin_uploads_and_external_fallbacks(): void
    {
        SiteAsset::query()->create([
            'key' => 'home.hero',
            'label' => 'Home — Hero (fundo)',
            'image_path' => 'site/upload-do-admin.jpg',
            'fallback_url' => '/images/site/home-hero.jpg',
        ]);
        SiteAsset::query()->create([
            'key' => 'gifts.placeholder',
            'label' => 'Presentes — Imagem padrão (sem foto)',
            'fallback_url' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=600&q=80',
        ]);

        $this->migration()->up();

        $hero = SiteAsset::query()->where('key', 'home.hero')->firstOrFail();
        $placeholder = SiteAsset::query()->where('key', 'gifts.placeholder')->firstOrFail();

        $this->assertSame('site/upload-do-admin.jpg', $hero->image_path);
        $this->assertSame('/images/site/home-hero.webp', $hero->fallback_url);
        $this->assertSame(
            'https://images.unsplash.com/photo-1519741497674-611481863552?w=600&q=80',
            $placeholder->fallback_url,
        );
    }

    public function test_migration_is_idempotent_and_ignores_unknown_paths(): void
    {
        SiteAsset::query()->create([
            'key' => 'home.hero',
            'label' => 'Home — Hero (fundo)',
            'fallback_url' => '/images/site/home-hero.webp',
        ]);
        SiteAsset::query()->create([
            'key' => 'custom.banner',
            'label' => 'Banner personalizado',
            'fallback_url' => '/images/site/banner-que-nao-convertemos.jpg',
        ]);

        $this->migration()->up();
        $this->migration()->up();

        $this->assertSame(
            '/images/site/home-hero.webp',
            SiteAsset::query()->where('key', 'home.hero')->value('fallback_url'),
        );
        $this->assertSame(
            '/images/site/banner-que-nao-convertemos.jpg',
            SiteAsset::query()->where('key', 'custom.banner')->value('fallback_url'),
            'Caminhos fora da conversão não devem ser alterados.',
        );
    }
}
