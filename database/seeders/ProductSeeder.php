<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            // Category 1: Electronics
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
                'description' => 'Flagship Samsung smartphone with advanced camera system.',
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

            // Category 2: Clothing
            [
                'category_id' => 2,
                'name' => 'Oversized Cotton T-Shirt',
                'description' => 'Comfortable oversized t-shirt made of 100% organic cotton.',
                'price' => 500,
                'discount' => 50,
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Slim Fit Denim Jeans',
                'description' => 'Classic blue denim jeans with a modern slim fit cut.',
                'price' => 1200,
                'discount' => 150,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Classic Leather Jacket',
                'description' => 'Premium quality black leather jacket with zip closure.',
                'price' => 3500,
                'discount' => 500,
                'stock' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Category 3: Home Appliances
            [
                'category_id' => 3,
                'name' => 'Smart Air Fryer XL',
                'description' => 'Large capacity air fryer with smart Wi-Fi controls.',
                'price' => 4500,
                'discount' => 400,
                'stock' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Espresso Coffee Machine',
                'description' => '15-bar pump espresso maker with milk frothing wand.',
                'price' => 8000,
                'discount' => 1000,
                'stock' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Smart Robot Vacuum',
                'description' => 'Self-charging vacuum cleaner with lidar navigation.',
                'price' => 15000,
                'discount' => 1500,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Category 4: Perfumes
            [
                'category_id' => 4,
                'name' => 'Bleu de Chanel',
                'description' => 'A woody, aromatic fragrance for men.',
                'price' => 6000,
                'discount' => 500,
                'stock' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'name' => 'Dior Sauvage',
                'description' => 'A radically fresh composition, raw and noble.',
                'price' => 5500,
                'discount' => 400,
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'name' => 'Creed Aventus',
                'description' => 'The exceptional Aventus cologne for men.',
                'price' => 12000,
                'discount' => 1000,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}