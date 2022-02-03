<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\ProductReview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_product_records_activity()
    {
        $product = Product::factory(['name' => 'created'])->create();

        $this->assertCount(1, $product->activity);
        $this->assertEquals('product_created', $product->activity->first()->description);
    }

    /** @test */
    public function updating_a_product_records_activity()
    {
        $product = Product::factory()->create();

        $product->update(['name' => 'Changed']);

        $this->assertCount(2, $product->activity);
        $this->assertEquals('product_updated', $product->activity->last()->description);
    }

    /** @test */
    public function adding_a_review_to_a_product_records_activity()
    {
        $product = Product::factory()->create();

        $product->addReview(ProductReview::factory()->raw());

        $this->assertCount(2, $product->activity);
        $this->assertEquals('review_created', $product->activity->last()->description);
    }

    /** @test */
    public function approving_a_review_on_a_product_records_activity()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $review = $product->addReview(ProductReview::factory()->raw());

        $this->patch($review->path(), [
            'approved' => true
        ]);

        $this->assertCount(3, $product->activity);
        $this->assertEquals('review_approved', $product->activity->last()->description);
    }

    /** @test */
    public function adding_a_question_to_a_product_records_activity()
    {
        $product = Product::factory()->create();

        $product->addQuestion(ProductQuestion::factory()->raw());

        $this->assertCount(2, $product->activity);
        $this->assertEquals('question_created', $product->activity->last()->description);
    }

    /** @test */
    public function approving_a_question_on_a_product_records_activity()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(ProductQuestion::factory()->raw());

        $this->patch($question->path(), [
            'approved' => true
        ]);

        $this->assertCount(3, $product->activity);
        $this->assertEquals('question_approved', $product->activity->last()->description);
    }
}
