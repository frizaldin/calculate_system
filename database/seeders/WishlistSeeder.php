<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing categories or create some if none exist
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $categories = Category::factory(5)->create();
        }

        // Create wishlists
        Wishlist::factory(20)->create([
            'category_id' => function () use ($categories) {
                return $categories->random()->id;
            }
        ]);
    }
}
