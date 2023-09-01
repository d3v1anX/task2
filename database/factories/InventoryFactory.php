<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Warehouse;
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
            //
            'stock' => $this->faker->randomNumber(5),
            'product_id' => $this->faker->randomElement(Product::all())['id'],
            'warehouse_id' => $this->faker->randomElement(Warehouse::all())['id'],
            'status' => 1,
        ];
    }
}
