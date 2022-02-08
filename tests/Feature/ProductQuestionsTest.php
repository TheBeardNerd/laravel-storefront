<?php

namespace Tests\Feature;

use App\Models\Product\Product;
use App\Models\Product\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductQuestionsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_product_can_have_questions()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(Question::factory()->raw());

        $this->post($product->path() . '/questions', $question->toArray());

        $this->get($product->path())->assertSee($question->question);
    }

    /** @test */
    public function a_question_can_be_approved()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(Question::factory()->raw());

        $this->patch($question->path(), [
            'approved' => true
        ]);

        $this->assertDatabaseHas('product_questions', [
            'approved' => true
        ]);
    }

    /** @test */
    public function a_question_can_be_disapproved()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(Question::factory()->raw());

        $this->patch($question->path(), [
            'approved' => true
        ]);

        $this->patch($question->path(), [
            'approved' => false
        ]);

        $this->assertDatabaseHas('product_questions', [
            'approved' => false
        ]);
    }

    /** @test */
    public function a_question_requires_a_body()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(
            Question::factory()->raw(['question' => ''])
        );

        $this->post($product->path() . '/questions', $question->toArray())->assertSessionHasErrors('question');
    }

    /** @test */
    public function a_question_requires_an_author()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(
            Question::factory()->raw(['author' => ''])
        );

        $this->post($product->path() . '/questions', $question->toArray())->assertSessionHasErrors('author');
    }
}
