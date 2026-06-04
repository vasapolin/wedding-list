<?php

namespace Tests\Feature;

use App\Models\Gift;
use App\Models\SiteAsset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteImagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_how_to_donate_hero_image_is_managed_by_site_asset(): void
    {
        SiteAsset::query()->create([
            'key' => 'how-to-donate.hero',
            'label' => 'Como Presentear — Hero',
            'fallback_url' => 'https://example.com/custom-hero.jpg',
        ]);

        $this->get('/como-doar')
            ->assertOk()
            ->assertSee('https://example.com/custom-hero.jpg');
    }

    public function test_how_to_donate_detail_image_is_managed_by_site_asset(): void
    {
        SiteAsset::query()->create([
            'key' => 'how-to-donate.detail',
            'label' => 'Como Presentear — Detalhe',
            'fallback_url' => 'https://example.com/custom-detail.jpg',
        ]);

        $this->get('/como-doar')
            ->assertOk()
            ->assertSee('https://example.com/custom-detail.jpg');
    }

    public function test_gift_without_image_uses_managed_placeholder_on_listing(): void
    {
        SiteAsset::query()->create([
            'key' => 'gifts.placeholder',
            'label' => 'Presentes — Imagem padrão',
            'fallback_url' => 'https://example.com/gift-placeholder.jpg',
        ]);

        Gift::factory()->create(['image_path' => null, 'is_active' => true]);

        $this->get('/presentes')
            ->assertOk()
            ->assertSee('https://example.com/gift-placeholder.jpg');
    }

    public function test_featured_gift_without_image_uses_managed_placeholder_on_home(): void
    {
        SiteAsset::query()->create([
            'key' => 'gifts.placeholder',
            'label' => 'Presentes — Imagem padrão',
            'fallback_url' => 'https://example.com/gift-placeholder.jpg',
        ]);

        Gift::factory()->create(['image_path' => null, 'is_active' => true]);

        $this->get('/')
            ->assertOk()
            ->assertSee('https://example.com/gift-placeholder.jpg');
    }
}
