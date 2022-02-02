<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\ProductQuestionAnswer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductQuestionAnswersTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_product_question_can_have_answers()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(ProductQuestion::factory()->raw());

        $answer = $question->addAnswer(ProductQuestionAnswer::factory()->raw());

        $this->post($question->path() . '/answers', $answer->toArray());

        $this->get($product->path())->assertSee($answer->body);
    }

    /** @test */
    public function an_answer_requires_a_body()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(ProductQuestion::factory()->raw());

        $answer = $question->addAnswer(ProductQuestionAnswer::factory()->raw(['body' => '']));

        $this->post($question->path() . '/answers', $answer->toArray())->assertSessionHasErrors('body');
    }

    /** @test */
    public function an_answer_requires_an_author()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(ProductQuestion::factory()->raw());

        $answer = $question->addAnswer(ProductQuestionAnswer::factory()->raw(['author' => '']));

        $this->post($question->path() . '/answers', $answer->toArray())->assertSessionHasErrors('author');
    }
}
