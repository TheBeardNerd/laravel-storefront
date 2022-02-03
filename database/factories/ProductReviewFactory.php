<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'rating' => $this->faker->numberBetween(1, 5),
            'author' => $this->faker->name(),
            'title' => $this->faker->words(5, true),
            'body' => $this->faker->text(),
            'recommended' => false,
            'helpful' => $this->faker->numberBetween(1, 20),
            'approved' => false
        ];
    }
}
