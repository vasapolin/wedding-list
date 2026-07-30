<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\DonationItem;
use App\Models\Gift;
use App\Services\AsaasClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PartialContributionTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirmed_payment_credits_each_gift_by_its_own_contribution(): void
    {
        $panelas = Gift::factory()->create(['price_cents' => 68_000, 'raised_cents' => 0]);
        $louca = Gift::factory()->create(['price_cents' => 230_000, 'raised_cents' => 0]);

        $donation = $this->donationWithItems([
            [$panelas, 20_000],
            [$louca, 50_000],
        ]);

        app(AsaasClient::class)->applyChargeStatus($donation, ['id' => 'pay_multi', 'status' => 'RECEIVED']);

        $this->assertSame(20_000, $panelas->fresh()->raised_cents);
        $this->assertSame(50_000, $louca->fresh()->raised_cents);
    }

    public function test_partial_contribution_moves_the_progress_percentage(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 100_000, 'raised_cents' => 0]);

        $donation = $this->donationWithItems([[$gift, 25_000]]);

        $this->assertSame(0, $gift->fresh()->progress_percentage);

        app(AsaasClient::class)->applyChargeStatus($donation, ['id' => 'pay_multi', 'status' => 'RECEIVED']);

        $this->assertSame(25, $gift->fresh()->progress_percentage);
    }

    public function test_contributions_from_different_donations_accumulate_on_the_same_gift(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 100_000, 'raised_cents' => 0]);

        $first = $this->donationWithItems([[$gift, 30_000]], 'pay_one');
        $second = $this->donationWithItems([[$gift, 45_000]], 'pay_two');

        $client = app(AsaasClient::class);
        $client->applyChargeStatus($first, ['id' => 'pay_one', 'status' => 'RECEIVED']);
        $client->applyChargeStatus($second, ['id' => 'pay_two', 'status' => 'CONFIRMED']);

        $this->assertSame(75_000, $gift->fresh()->raised_cents);
    }

    public function test_items_are_credited_only_once_when_webhook_repeats(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 100_000, 'raised_cents' => 0]);

        $donation = $this->donationWithItems([[$gift, 30_000]]);

        $client = app(AsaasClient::class);
        $client->applyChargeStatus($donation, ['id' => 'pay_multi', 'status' => 'RECEIVED']);
        $client->applyChargeStatus($donation, ['id' => 'pay_multi', 'status' => 'CONFIRMED']);

        $this->assertSame(30_000, $gift->fresh()->raised_cents);
    }

    public function test_refund_reverts_each_gift_contribution(): void
    {
        $panelas = Gift::factory()->create(['price_cents' => 68_000, 'raised_cents' => 0]);
        $louca = Gift::factory()->create(['price_cents' => 230_000, 'raised_cents' => 0]);

        $donation = $this->donationWithItems([
            [$panelas, 20_000],
            [$louca, 50_000],
        ]);

        $client = app(AsaasClient::class);
        $client->applyChargeStatus($donation, ['id' => 'pay_multi', 'status' => 'RECEIVED']);
        $client->applyChargeStatus($donation, ['id' => 'pay_multi', 'status' => 'REFUNDED']);

        $this->assertSame(0, $panelas->fresh()->raised_cents);
        $this->assertSame(0, $louca->fresh()->raised_cents);
    }

    public function test_legacy_single_gift_donation_without_items_still_credits(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 50_000, 'raised_cents' => 0]);

        $donation = Donation::factory()->create([
            'gift_id' => $gift->id,
            'amount_cents' => 10_000,
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => 'pay_legacy',
        ]);

        app(AsaasClient::class)->applyChargeStatus($donation, ['id' => 'pay_legacy', 'status' => 'RECEIVED']);

        $this->assertSame(10_000, $gift->fresh()->raised_cents);
    }

    public function test_gift_exposes_how_much_is_still_missing(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 100_000, 'raised_cents' => 30_000]);

        $this->assertSame(70_000, $gift->remaining_cents);
        $this->assertFalse($gift->isFullyFunded());
    }

    public function test_fully_funded_gift_reports_no_remaining_amount(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 100_000, 'raised_cents' => 100_000]);

        $this->assertSame(0, $gift->remaining_cents);
        $this->assertTrue($gift->isFullyFunded());
    }

    public function test_overfunded_gift_never_reports_negative_remaining(): void
    {
        $gift = Gift::factory()->create(['price_cents' => 100_000, 'raised_cents' => 130_000]);

        $this->assertSame(0, $gift->remaining_cents);
        $this->assertSame(100, $gift->progress_percentage);
    }

    /**
     * @param  array<int, array{0: Gift, 1: int}>  $lines
     */
    protected function donationWithItems(array $lines, string $paymentId = 'pay_multi'): Donation
    {
        $donation = Donation::factory()->create([
            'gift_id' => null,
            'amount_cents' => array_sum(array_column($lines, 1)),
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => $paymentId,
        ]);

        foreach ($lines as [$gift, $amountCents]) {
            DonationItem::query()->create([
                'donation_id' => $donation->id,
                'gift_id' => $gift->id,
                'amount_cents' => $amountCents,
            ]);
        }

        return $donation->refresh();
    }
}
