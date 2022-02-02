<?php

namespace Database\Factories;

use App\Models\ProductQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductQuestionAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_question_id' => ProductQuestion::factory(),
            'body' => $this->faker->sentence(),
            'author' => $this->faker->name(),
        ];
    }
}
