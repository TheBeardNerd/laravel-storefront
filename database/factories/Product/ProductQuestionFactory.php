<?php

namespace Database\Factories\Product;

use App\Models\Product\Product;
use App\Models\Product\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'question' => $this->faker->sentence(),
            'author' => $this->faker->name(),
            'approved' => false
        ];
    }
}
