<?php

namespace Tests\Feature;

use App\Filament\Widgets\DonationsChart;
use App\Filament\Widgets\DonationStatsOverview;
use App\Filament\Widgets\LatestDonations;
use App\Filament\Widgets\PopularGifts;
use App\Models\Donation;
use App\Models\Gift;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }

    public function test_dashboard_renders_all_widgets(): void
    {
        $this->actingAsAdmin();

        $response = $this->get('/admin');

        $response->assertOk();
        $response->assertSeeLivewire(DonationStatsOverview::class);
        $response->assertSeeLivewire(DonationsChart::class);
        $response->assertSeeLivewire(LatestDonations::class);
        $response->assertSeeLivewire(PopularGifts::class);
    }

    public function test_stats_overview_shows_paid_totals_and_counts(): void
    {
        $this->actingAsAdmin();

        Donation::factory()->create(['status' => Donation::STATUS_PAID, 'amount_cents' => 150_00, 'paid_at' => now()]);
        Donation::factory()->create(['status' => Donation::STATUS_PAID, 'amount_cents' => 250_00, 'paid_at' => now()]);
        Donation::factory()->create(['status' => Donation::STATUS_PENDING, 'amount_cents' => 999_00]);
        Message::factory()->count(3)->create();

        Livewire::test(DonationStatsOverview::class)
            ->assertSee('R$ 400,00')
            ->assertSee('Total arrecadado')
            ->assertSee('Doações pagas')
            ->assertSee('2')
            ->assertSee('Aguardando pagamento')
            ->assertSee('Mensagens no mural')
            ->assertSee('3');
    }

    public function test_donations_chart_aggregates_paid_donations_by_day(): void
    {
        $this->actingAsAdmin();

        Donation::factory()->create([
            'status' => Donation::STATUS_PAID,
            'amount_cents' => 100_00,
            'paid_at' => now(),
        ]);
        Donation::factory()->create([
            'status' => Donation::STATUS_PAID,
            'amount_cents' => 50_00,
            'paid_at' => now(),
        ]);
        Donation::factory()->create([
            'status' => Donation::STATUS_PAID,
            'amount_cents' => 70_00,
            'paid_at' => now()->subDays(2),
        ]);
        Donation::factory()->create([
            'status' => Donation::STATUS_PENDING,
            'amount_cents' => 999_00,
        ]);

        $widget = new DonationsChart;
        $method = new \ReflectionMethod($widget, 'getData');
        $data = $method->invoke($widget);

        $points = $data['datasets'][0]['data'];

        $this->assertSame(150.0, end($points));
        $this->assertSame(70.0, $points[count($points) - 3]);
        $this->assertSame(220.0, array_sum($points));
    }

    public function test_latest_donations_widget_lists_recent_donations(): void
    {
        $this->actingAsAdmin();

        $donations = Donation::factory()->count(3)->create([
            'status' => Donation::STATUS_PAID,
            'paid_at' => now(),
        ]);

        Livewire::test(LatestDonations::class)
            ->assertCanSeeTableRecords($donations);
    }

    public function test_popular_gifts_widget_orders_by_raised(): void
    {
        $this->actingAsAdmin();

        $top = Gift::factory()->create(['name' => 'Lua de Mel', 'price_cents' => 100_00, 'raised_cents' => 90_00]);
        $bottom = Gift::factory()->create(['name' => 'Kit Cozinha', 'price_cents' => 100_00, 'raised_cents' => 10_00]);

        Livewire::test(PopularGifts::class)
            ->assertCanSeeTableRecords([$top, $bottom], inOrder: true);
    }
}
