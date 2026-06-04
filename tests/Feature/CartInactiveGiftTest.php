<?php

namespace Tests\Feature;

use App\Models\Gift;
use App\Services\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartInactiveGiftTest extends TestCase
{
    use RefreshDatabase;

    public function test_gift_deactivated_after_being_added_is_dropped_from_cart(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 50_000, 'is_active' => true]);

        $this->post(route('cart.add', $gift));

        $cart = app(Cart::class);
        $this->assertCount(1, $cart->items());
        $this->assertSame(50_000, $cart->totalCents());

        $gift->update(['is_active' => false]);

        $this->assertCount(0, $cart->items());
        $this->assertSame(0, $cart->totalCents());
        $this->assertTrue($cart->isEmpty());
    }

    public function test_inactive_gift_cannot_be_added_to_cart(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 50_000, 'is_active' => false]);

        $this->post(route('cart.add', $gift))->assertNotFound();

        $this->assertTrue(app(Cart::class)->isEmpty());
    }
}
