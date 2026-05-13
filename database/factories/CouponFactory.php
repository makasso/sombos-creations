<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->word()),
            'discount' => $this->faker->randomFloat(2, 5, 50),
            'max_uses' => $this->faker->numberBetween(10, 100),
            'used_count' => $this->faker->numberBetween(0, 50),
            'valid_from' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'valid_until' => $this->faker->dateTimeBetween('+1 month', '+3 months'),
        ];
    }
}
