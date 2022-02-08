<?php

namespace Tests\Feature;

use App\Models\Product\Product;
use App\Models\Product\Question;
use App\Models\Product\Answer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductAnswersTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_product_question_can_have_answers()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(Question::factory()->raw());

        $answer = $question->addAnswer(Answer::factory()->raw());

        $this->post($question->path() . '/answers', $answer->toArray());

        $this->get($product->path())->assertSee($answer->body);
    }

    /** @test */
    public function an_answer_requires_a_body()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(Question::factory()->raw());

        $answer = $question->addAnswer(Answer::factory()->raw(['body' => '']));

        $this->post($question->path() . '/answers', $answer->toArray())->assertSessionHasErrors('body');
    }

    /** @test */
    public function an_answer_requires_an_author()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(Question::factory()->raw());

        $answer = $question->addAnswer(Answer::factory()->raw(['author' => '']));

        $this->post($question->path() . '/answers', $answer->toArray())->assertSessionHasErrors('author');
    }
}
