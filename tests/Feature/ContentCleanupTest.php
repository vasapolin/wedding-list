<?php

namespace Tests\Feature;

use App\Models\Gift;
use Database\Seeders\GiftSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentCleanupTest extends TestCase
{
    use RefreshDatabase;

    public function test_faq_does_not_promise_confirmation_emails(): void
    {
        $this->get('/como-doar')
            ->assertOk()
            ->assertDontSee('e-mail de confirmacao')
            ->assertDontSee('e-mail de confirmação');
    }

    public function test_gift_seeder_starts_with_zero_raised(): void
    {
        $this->seed(GiftSeeder::class);

        $this->assertGreaterThan(0, Gift::query()->count());
        $this->assertSame(0, (int) Gift::query()->max('raised_cents'));
    }
}
