<?php

namespace Tests\Feature;

use App\Models\Product\Product;
use App\Models\Product\Question;
use App\Models\Product\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecordActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_product()
    {
        $product = Product::factory(['name' => 'created'])->create();

        $this->assertCount(1, $product->activity);

        tap($product->activity->last(), function ($activity) {
            $this->assertEquals('created_product', $activity->description);

            $this->assertNull($activity->changes);
        });
    }

    /** @test */
    public function updating_a_product()
    {
        $product = Product::factory()->create();

        $originalName = $product->name;

        $product->update(['name' => 'Changed']);

        $this->assertCount(2, $product->activity);

        tap($product->activity->last(), function ($activity) use ($originalName) {
            $this->assertEquals('updated_product', $activity->description);

            $expected = [
                'before' => ['name' => $originalName],
                'after' => ['name' => 'Changed']
            ];

            $this->assertEquals($expected, $activity->changes);
        });
    }

    /** @test */
    public function adding_a_review_to_a_product()
    {
        $product = Product::factory()->create();

        $review = $product->addReview(Review::factory()->raw());

        $this->assertCount(2, $product->activity);

        tap($product->activity->last(), function($activity) use ($review) {
            $this->assertEquals('created_review', $activity->description);
            $this->assertInstanceOf(Review::class, $activity->subject);
            $this->assertEquals($review->body, $activity->subject->body);
        });
    }

    /** @test */
    public function approving_a_review_on_a_product()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $review = $product->addReview(Review::factory()->raw());

        $this->patch($review->path(), [
            'approved' => true
        ]);

        $this->assertCount(3, $product->activity);

        tap($product->activity->last(), function($activity) use ($review) {
            $this->assertEquals('updated_review', $activity->description);
            $this->assertInstanceOf(Review::class, $activity->subject);
            $this->assertEquals($review->body, $activity->subject->body);
        });
    }

    /** @test */
    public function disapproving_a_review_on_a_product()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $review = $product->addReview(Review::factory()->raw());

        $this->patch($review->path(), [
            'approved' => true
        ]);

        $this->assertCount(3, $product->activity);

        tap($product->activity->last(), function($activity) use ($review) {
            $this->assertEquals('updated_review', $activity->description);
            $this->assertInstanceOf(Review::class, $activity->subject);
            $this->assertEquals($review->body, $activity->subject->body);
        });

        $this->patch($review->path(), [
            'approved' => false
        ]);

        $product->refresh();

        $this->assertCount(4, $product->activity);

        tap($product->activity->last(), function($activity) use ($review) {
            $this->assertEquals('updated_review', $activity->description);
            $this->assertInstanceOf(Review::class, $activity->subject);
            $this->assertEquals($review->body, $activity->subject->body);
        });
    }

    /** @test */
    public function adding_a_question_to_a_product()
    {
        $product = Product::factory()->create();

        $question = $product->addQuestion(Question::factory()->raw());

        $this->assertCount(2, $product->activity);

        tap($product->activity->last(), function($activity) use ($question) {
            $this->assertEquals('created_question', $activity->description);
            $this->assertInstanceOf(Question::class, $activity->subject);
            $this->assertEquals($question->question, $activity->subject->question);
        });
    }

    /** @test */
    public function approving_a_question_on_a_product()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(Question::factory()->raw());

        $this->patch($question->path(), [
            'approved' => true
        ]);

        $this->assertCount(3, $product->activity);

        tap($product->activity->last(), function($activity) use ($question) {
            $this->assertEquals('updated_question', $activity->description);
            $this->assertInstanceOf(Question::class, $activity->subject);
            $this->assertEquals($question->question, $activity->subject->question);
        });
    }

    /** @test */
    public function disapproving_a_question_on_a_product()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $question = $product->addQuestion(Question::factory()->raw());

        $this->patch($question->path(), [
            'approved' => true
        ]);

        $this->assertCount(3, $product->activity);

        tap($product->activity->last(), function($activity) use ($question) {
            $this->assertEquals('updated_question', $activity->description);
            $this->assertInstanceOf(Question::class, $activity->subject);
            $this->assertEquals($question->question, $activity->subject->question);
        });

        $this->patch($question->path(), [
            'approved' => false
        ]);

        $product->refresh();

        $this->assertCount(4, $product->activity);
        $this->assertEquals('updated_question', $product->activity->last()->description);

        tap($product->activity->last(), function($activity) use ($question) {
            $this->assertEquals('updated_question', $activity->description);
            $this->assertInstanceOf(Question::class, $activity->subject);
            $this->assertEquals($question->question, $activity->subject->question);
        });
    }
}
