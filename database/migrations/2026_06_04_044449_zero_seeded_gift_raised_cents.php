<?php

use App\Models\Donation;
use App\Models\Gift;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * The original GiftSeeder shipped fake raised_cents values that were
     * seeded into production. Reset every gift's raised total to the sum of
     * its actually-paid donations (zero for all gifts at the time of writing).
     */
    public function up(): void
    {
        Gift::query()->each(function (Gift $gift) {
            $paidCents = (int) Donation::query()
                ->where('gift_id', $gift->id)
                ->where('status', Donation::STATUS_PAID)
                ->sum('amount_cents');

            $gift->update(['raised_cents' => $paidCents]);
        });
    }

    public function down(): void
    {
        //
    }
};
