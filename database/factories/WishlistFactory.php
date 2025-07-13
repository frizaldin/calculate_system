<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wishlist>
 */
class WishlistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = $this->faker->randomFloat(2, 10000, 1000000);
        $qty = $this->faker->numberBetween(1, 10);

        return [
            'category_id' => Category::factory(),
            'photo' => $this->faker->imageUrl(400, 400, 'products'),
            'name' => $this->faker->words(3, true),
            'price' => $price,
            'qty' => $qty,
            'total_price' => $price * $qty,
            'link_ecommerce' => $this->faker->url(),
        ];
    }
}
