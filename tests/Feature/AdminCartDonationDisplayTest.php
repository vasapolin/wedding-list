<?php

namespace Tests\Feature;

use App\Filament\Resources\Donations\Pages\ListDonations;
use App\Filament\Widgets\LatestDonations;
use App\Models\Donation;
use App\Models\Gift;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminCartDonationDisplayTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }

    /**
     * @param  array<int, Gift>  $gifts
     */
    protected function cartDonation(array $gifts): Donation
    {
        $donation = Donation::factory()->create([
            'gift_id' => null,
            'amount_cents' => 100_00 * count($gifts),
        ]);

        foreach ($gifts as $gift) {
            $donation->items()->create(['gift_id' => $gift->id, 'amount_cents' => 100_00]);
        }

        return $donation;
    }

    public function test_donation_list_names_the_gift_behind_a_single_item_cart_donation(): void
    {
        $this->actingAsAdmin();

        $this->cartDonation([Gift::factory()->create(['name' => 'Jantar em Paris'])]);

        Livewire::test(ListDonations::class)
            ->assertSee('Jantar em Paris')
            ->assertDontSee('Doação livre');
    }

    public function test_donation_list_summarises_a_multi_gift_cart_donation(): void
    {
        $this->actingAsAdmin();

        $this->cartDonation([
            Gift::factory()->create(['name' => 'Jantar em Paris']),
            Gift::factory()->create(['name' => 'Passeio de Barco']),
        ]);

        Livewire::test(ListDonations::class)
            ->assertSee('2 presentes')
            ->assertDontSee('Doação livre');
    }

    public function test_donation_list_still_names_legacy_donations_tied_to_gift_id(): void
    {
        $this->actingAsAdmin();

        $gift = Gift::factory()->create(['name' => 'Geladeira']);
        Donation::factory()->create(['gift_id' => $gift->id]);

        Livewire::test(ListDonations::class)->assertSee('Geladeira');
    }

    public function test_donation_list_marks_free_donations_as_such(): void
    {
        $this->actingAsAdmin();

        Donation::factory()->create(['gift_id' => null]);

        Livewire::test(ListDonations::class)->assertSee('Doação livre');
    }

    public function test_donation_list_search_finds_cart_donations_by_gift_name(): void
    {
        $this->actingAsAdmin();

        $wanted = $this->cartDonation([Gift::factory()->create(['name' => 'Jantar em Paris'])]);
        $other = $this->cartDonation([Gift::factory()->create(['name' => 'Passeio de Barco'])]);

        Livewire::test(ListDonations::class)
            ->searchTable('Jantar em Paris')
            ->assertCanSeeTableRecords([$wanted])
            ->assertCanNotSeeTableRecords([$other]);
    }

    public function test_latest_donations_widget_names_cart_gifts(): void
    {
        $this->actingAsAdmin();

        $this->cartDonation([Gift::factory()->create(['name' => 'Jantar em Paris'])]);

        Livewire::test(LatestDonations::class)->assertSee('Jantar em Paris');
    }

    public function test_gift_summary_does_not_run_a_query_per_donation(): void
    {
        $gifts = Gift::factory()->count(2)->create();
        foreach (range(1, 5) as $ignored) {
            $this->cartDonation($gifts->all());
        }

        $donations = Donation::query()->with('items.gift')->get();

        $queries = 0;
        \Illuminate\Support\Facades\DB::listen(function () use (&$queries): void {
            $queries++;
        });

        $donations->each(fn (Donation $donation) => $donation->gift_summary);

        $this->assertSame(0, $queries, 'gift_summary deve reaproveitar o eager loading em vez de consultar por linha.');
    }
}
