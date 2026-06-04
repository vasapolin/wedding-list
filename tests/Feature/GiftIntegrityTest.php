<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Gift;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GiftIntegrityTest extends TestCase
{
    use RefreshDatabase;

    public function test_gift_with_paid_donations_cannot_be_deleted(): void
    {
        $gift = Gift::factory()->create(['raised_cents' => 10_000]);
        Donation::factory()->create([
            'gift_id' => $gift->id,
            'status' => Donation::STATUS_PAID,
            'paid_at' => now(),
        ]);

        $this->assertFalse($gift->delete());
        $this->assertNotNull(Gift::query()->find($gift->id));
    }

    public function test_gift_without_paid_donations_can_be_deleted(): void
    {
        $gift = Gift::factory()->create();
        Donation::factory()->create([
            'gift_id' => $gift->id,
            'status' => Donation::STATUS_PENDING,
        ]);

        $this->assertTrue($gift->delete());
        $this->assertNull(Gift::query()->find($gift->id));
    }

    public function test_progress_percentage_is_consistent_between_model_and_widget(): void
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $gift = Gift::factory()->create(['price_cents' => 50_000, 'raised_cents' => 30_400]);

        $this->assertSame(60, $gift->progress_percentage);

        \Livewire\Livewire::test(\App\Filament\Widgets\PopularGifts::class)
            ->assertSee('60%')
            ->assertDontSee('61%');
    }
}
