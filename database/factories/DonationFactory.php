<?php

namespace Database\Factories;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Donation>
 */
class DonationFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'gift_id' => null,
            'donor_name' => fake()->name(),
            'donor_email' => fake()->safeEmail(),
            'amount_cents' => fake()->numberBetween(5_000, 50_000),
            'message' => fake()->optional()->sentence(),
            'is_anonymous' => false,
            'payment_method' => 'pix',
            'status' => Donation::STATUS_PENDING,
            'asaas_payment_id' => null,
            'asaas_payload' => null,
            'paid_at' => null,
        ];
    }

    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Donation::STATUS_PAID,
            'paid_at' => now(),
        ]);
    }
}
