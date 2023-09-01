<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vendor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VendorShop>
 */
class VendorShopFactory extends Factory
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
            'shop_name' => fake()->name(),
            'vendor_id' => $this->faker->randomElement(Vendor::all())['id'],
            'status' => 1,
        ];
    }
}
