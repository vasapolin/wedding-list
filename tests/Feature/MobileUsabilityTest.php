<?php

namespace Tests\Feature;

use App\Models\Gift;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MobileUsabilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_mobile_menu_button_is_accessible_with_adequate_touch_area(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('aria-label="Abrir menu"', false)
            ->assertSee(':aria-expanded', false);

        $html = $response->getContent();
        $this->assertMatchesRegularExpression(
            '/<button[^>]*aria-label="Abrir menu"[^>]*class="[^"]*p-2[^"]*"/s',
            $html,
            'O botão do menu mobile precisa de padding para alvo de toque >= 40px.',
        );
    }

    public function test_mobile_menu_links_have_comfortable_touch_height(): void
    {
        $html = $this->get('/')->getContent();

        $this->assertMatchesRegularExpression(
            '/x-show="mobileOpen"[\s\S]*?<a[^>]*class="[^"]*py-2[^"]*"/',
            $html,
            'Itens do menu mobile precisam de py-2 para altura de toque adequada.',
        );
    }

    public function test_gift_listing_images_have_loading_background(): void
    {
        Gift::factory()->create(['is_active' => true]);

        $html = $this->get('/presentes')->getContent();

        $this->assertMatchesRegularExpression(
            '/class="aspect-\[4\/3\] bg-cover bg-center bg-surface-light/',
            $html,
            'Imagens dos presentes precisam de bg-surface-light enquanto carregam.',
        );
    }
}
