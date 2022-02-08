<?php

namespace Tests\Feature;

use App\Models\Product\Product;
use App\Models\Product\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductReviewsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_product_can_have_reviews()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $review = $product->addReview(Review::factory()->raw());

        $this->post($product->path() . '/reviews', $review->toArray());

        $this->get($product->path())->assertSee($review->body);
    }

    /** @test */
    public function a_review_can_be_approved()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $review = $product->addReview(Review::factory()->raw());

        $this->patch($review->path(), [
            'approved' => true
        ]);

        $this->assertDatabaseHas('product_reviews', [
            'approved' => true
        ]);
    }

    /** @test */
    public function a_review_can_be_disapproved()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $review = $product->addReview(Review::factory()->raw());

        $this->patch($review->path(), [
            'approved' => true
        ]);

        $this->patch($review->path(), [
            'approved' => false
        ]);

        $this->assertDatabaseHas('product_reviews', [
            'approved' => false
        ]);
    }

    /** @test */
    public function a_review_requires_a_title()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $review = $product->addReview(
            Review::factory()->raw(['title' => ''])
        );

        $this->post($product->path() . '/reviews', $review->toArray())->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_review_requires_a_body()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $review = $product->addReview(
            Review::factory()->raw(['body' => ''])
        );

        $this->post($product->path() . '/reviews', $review->toArray())->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_review_requires_an_author()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $review = $product->addReview(
            Review::factory()->raw(['author' => ''])
        );

        $this->post($product->path() . '/reviews', $review->toArray())->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_review_requires_a_rating()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $review = $product->addReview(
            Review::factory()->raw(['rating' => null])
        );

        $this->post($product->path() . '/reviews', $review->toArray())->assertSessionHasErrors('rating');
    }
}
