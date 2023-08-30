<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Inventory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\Product::factory(5)->create();
         \App\Models\VendorShop::factory(6)->create();
         \App\Models\Warehouse::factory(2)->create();
         \App\Models\Price::factory(6)->create();
         \App\Models\Inventory::factory(5)->create();


         Permission::create(['name' => 'product-list']);
         Permission::create(['name' => 'product-create']);
         Permission::create(['name' => 'product-edit']);
         Permission::create(['name' => 'product-delete']);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
