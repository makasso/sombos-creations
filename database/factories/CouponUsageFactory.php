<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CouponUsage>
 */
class CouponUsageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 20), // Assuming 20 users exist
            'coupon_id' => $this->faker->numberBetween(1, 10), // Assuming 10 coupons exist
            'order_id' => $this->faker->numberBetween(1, 30), // Assuming 30 orders exist
        ];
    }
}
