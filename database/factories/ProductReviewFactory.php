<?php

namespace Database\Factories;

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
            'rating' => $this->faker->numberBetween(1, 5),
            'author' => $this->faker->name(),
            'title' => $this->faker->words(5, true),
            'body' => $this->faker->text(),
            'recommended' => true,
            'helpful' => $this->faker->numberBetween(1, 20)
        ];
    }
}
