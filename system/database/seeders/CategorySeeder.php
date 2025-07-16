<?php

namespace Database\Seeders;

use App\Models\Category;
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
                'description' => 'Electronic products and gadgets',
                'type' => 'Wishlist',
                'status' => true,
            ],
            [
                'name' => 'Fashion',
                'description' => 'Clothing and fashion accessories',
                'type' => 'Wishlist',
                'status' => true,
            ],
            [
                'name' => 'Books',
                'description' => 'Books and educational materials',
                'type' => 'Wishlist',
                'status' => true,
            ],
            [
                'name' => 'Sports',
                'description' => 'Sports equipment and accessories',
                'type' => 'Wishlist',
                'status' => true,
            ],
            [
                'name' => 'Home & Garden',
                'description' => 'Home improvement and garden supplies',
                'type' => 'Wishlist',
                'status' => false,
            ],
            [
                'name' => 'Automotive',
                'description' => 'Automotive parts and accessories',
                'type' => 'Wishlist',
                'status' => true,
            ],
            [
                'name' => 'Health & Beauty',
                'description' => 'Health and beauty products',
                'type' => 'Wishlist',
                'status' => true,
            ],
            [
                'name' => 'Toys & Games',
                'description' => 'Toys and games for all ages',
                'type' => 'Wishlist',
                'status' => false,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
