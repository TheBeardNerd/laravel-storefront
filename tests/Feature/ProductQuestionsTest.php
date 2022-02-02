<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductQuestion;
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

        $question = $product->addQuestion(ProductQuestion::factory()->raw());

        $this->post($product->path() . '/questions', $question->toArray());

        $this->get($product->path())->assertSee($question->question);
    }

    /** @test */
    public function a_question_can_be_approved()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(ProductQuestion::factory()->raw());

        $this->patch($question->path(), [
            'approved' => true
        ]);

        $this->assertDatabaseHas('product_questions', [
            'approved' => true
        ]);
    }

    /** @test */
    public function a_question_requires_a_body()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(
            ProductQuestion::factory()->raw(['question' => ''])
        );

        $this->post($product->path() . '/questions', $question->toArray())->assertSessionHasErrors('question');
    }

    /** @test */
    public function a_question_requires_an_author()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(
            ProductQuestion::factory()->raw(['author' => ''])
        );

        $this->post($product->path() . '/questions', $question->toArray())->assertSessionHasErrors('author');
    }
}
