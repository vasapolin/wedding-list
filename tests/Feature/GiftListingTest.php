<?php

namespace Tests\Feature;

use App\Models\Gift;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GiftListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_gift_index_lists_active_gifts(): void
    {
        Gift::factory()->create(['name' => 'Visible Gift', 'is_active' => true]);
        Gift::factory()->create(['name' => 'Hidden Gift', 'is_active' => false]);

        $response = $this->get('/presentes');

        $response->assertOk();
        $response->assertSeeText('Visible Gift');
        $response->assertDontSeeText('Hidden Gift');
    }

    public function test_filter_premium_only_shows_high_priced(): void
    {
        Gift::factory()->create(['name' => 'Cheap', 'price_cents' => 5_000, 'is_active' => true]);
        Gift::factory()->create(['name' => 'Premium', 'price_cents' => 80_000, 'is_active' => true]);

        $response = $this->get('/presentes?filter=premium');

        $response->assertOk();
        $response->assertSeeText('Premium');
        $response->assertDontSeeText('Cheap');
    }
}
