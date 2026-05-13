<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 50), // Assuming 50 products exist
            'attribute_value_id' => $this->faker->numberBetween(1, 20), // Assuming 20 attribute values exist
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
