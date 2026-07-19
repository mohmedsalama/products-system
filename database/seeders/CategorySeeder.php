<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Smart electronic devices like phones and computers.',
                'image' => 'default.png',
            ],
            [
                'name' => 'Clothing',
                'description' => 'Latest fashion trends and apparel.',
                'image' => 'default.png',
            ],
            [
                'name' => 'Home Appliances',
                'description' => 'Everything your home needs from electrical appliances.',
                'image' => 'default.png',
            ],
            [
                'name' => 'Perfumes',
                'description' => 'A variety of luxurious perfumes.',
                'image' => 'default.png',
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
