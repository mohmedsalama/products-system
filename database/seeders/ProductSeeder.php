<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'category_id' => 1,
                'name' => 'Apple AirPods Pro 2',
                'description' => 'Wireless earbuds with Active Noise Cancellation.',
                'price' => 12000,
                'discount' => 1000,
                'stock' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Samsung Galaxy S25 Ultra',
                'description' => 'Flagship Samsung smartphone with advanced camera.',
                'price' => 65000,
                'discount' => 5000,
                'stock' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'MacBook Pro M4',
                'description' => 'Apple laptop powered by the M4 chip.',
                'price' => 90000,
                'discount' => 7000,
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Sony WH-1000XM5',
                'description' => 'Wireless noise cancelling headphones.',
                'price' => 18000,
                'discount' => 2000,
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Apple Watch Series 10',
                'description' => 'Smart watch with health and fitness tracking.',
                'price' => 25000,
                'discount' => 3000,
                'stock' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Logitech MX Master 3S',
                'description' => 'Professional wireless productivity mouse.',
                'price' => 6000,
                'discount' => 500,
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}