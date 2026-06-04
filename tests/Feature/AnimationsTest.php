<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnimationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_has_petals_reveals_and_parallax_layers(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('data-petals', false)
            ->assertSee('data-sparkles', false)
            ->assertSee('data-reveal', false)
            ->assertSee('data-parallax', false);
    }

    public function test_messages_page_has_petals_and_reveals(): void
    {
        $this->get('/mensagens')
            ->assertOk()
            ->assertSee('data-petals', false)
            ->assertSee('data-reveal', false);
    }

    public function test_gift_listing_reveals_content(): void
    {
        $this->get('/presentes')
            ->assertOk()
            ->assertSee('data-reveal', false);
    }

    public function test_how_to_donate_reveals_content(): void
    {
        $this->get('/como-doar')
            ->assertOk()
            ->assertSee('data-reveal', false);
    }

    public function test_stylesheet_respects_reduced_motion_and_no_js(): void
    {
        $css = file_get_contents(resource_path('css/app.css'));

        $this->assertStringContainsString('prefers-reduced-motion', $css);
        $this->assertStringContainsString('html.js [data-reveal]', $css);
        $this->assertStringContainsString('petal', $css);
        $this->assertStringContainsString('sparkle', $css);
    }

    public function test_layout_flags_js_availability_for_reveal_fallback(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee("document.documentElement.classList.add('js')", false);
    }

    public function test_frontend_script_wires_reveal_petals_and_parallax(): void
    {
        $js = file_get_contents(resource_path('js/app.js'));

        $this->assertStringContainsString('IntersectionObserver', $js);
        $this->assertStringContainsString('data-petals', $js);
        $this->assertStringContainsString('data-sparkles', $js);
        $this->assertStringContainsString('data-parallax', $js);
        $this->assertStringContainsString('prefers-reduced-motion', $js);
    }
}
