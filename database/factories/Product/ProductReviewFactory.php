<?php

namespace Database\Factories\Product;

use App\Models\Product\Product;
use App\Models\Product\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

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
