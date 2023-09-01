<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vendor;
use App\Models\ProductGroup;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'product_name' => fake()->word(),
            'product_description' => fake()->text(100),
            'sku' => random_int(1000000000,9999999999),
            'vendor_id' => Vendor::factory(),
            'product_group_id' => ProductGroup::factory(),
            'status' => 1,
            
        ];
    }
}
