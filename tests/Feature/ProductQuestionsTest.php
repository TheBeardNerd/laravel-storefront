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
        $this->withoutExceptionHandling();

        $this->signIn();

        $product = Product::factory()->create();

        $attributes = ProductQuestion::factory([ 'product_id' => $product->id ])->raw();

        $this->post($product->path() . '/questions', $attributes);

        $this->get($product->path())->assertSee($attributes['question']);
    }

    /** @test */
    public function a_product_can_be_approved()
    {
        $this->withoutExceptionHandling();

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
}
