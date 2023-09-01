<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\VendorShop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
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
            'sale_price' => $this->faker->randomNumber(5),
            'product_id' => $this->faker->randomElement(Product::all())['id'],
            'shop_id' => $this->faker->randomElement(VendorShop::all())['id'],
            'status' => 1,
        ];
    }
}
