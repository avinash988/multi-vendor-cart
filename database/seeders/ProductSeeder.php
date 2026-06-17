<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'vendor_id' => 1,
            'name' => 'T Shirt',
            'price' => 500,
            'stock' => 100
        ]);

        Product::create([
            'vendor_id' => 1,
            'name' => 'Jeans',
            'price' => 1200,
            'stock' => 50
        ]);

        Product::create([
            'vendor_id' => 2,
            'name' => 'Shoes',
            'price' => 2000,
            'stock' => 30
        ]);

        Product::create([
            'vendor_id' => 2,
            'name' => 'Cap',
            'price' => 300,
            'stock' => 100
        ]);
    }
}