<?php

namespace Database\Factories\Product;

use App\Models\Product\Answer;
use App\Models\Product\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Answer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question_id' => Question::factory(),
            'body' => $this->faker->sentence(),
            'author' => $this->faker->name(),
        ];
    }
}
