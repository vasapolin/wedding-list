<?php

namespace Tests\Feature;

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

    public function test_gallery_images_have_loading_background(): void
    {
        $html = $this->get('/')->getContent();

        $this->assertMatchesRegularExpression(
            '/id="nossa-historia"[\s\S]*?class="relative col-span-1 md:row-span-2 overflow-hidden aspect-\[3\/4\] md:aspect-auto bg-surface-light/',
            $html,
            'Containers da galeria precisam de bg-surface-light enquanto a imagem carrega.',
        );
    }
}
