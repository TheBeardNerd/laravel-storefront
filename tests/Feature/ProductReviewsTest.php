<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductReviewsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_product_can_have_reviews()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $product = Product::factory()->create();

        $attributes = ProductReview::factory([ 'product_id' => $product->id ])->raw();

        $this->post($product->path() . '/reviews', $attributes);

        $this->assertDatabaseHas('product_reviews', $attributes);

        $this->get($product->path())->assertSee($attributes['body']);
    }

    /** @test */
    public function a_product_can_be_approved()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $product = Product::factory()->create();

        $review = $product->addReview(ProductReview::factory()->raw());

        $this->patch($review->path(), [
            'approved' => true
        ]);

        $this->assertDatabaseHas('product_reviews', [
            'approved' => true
        ]);
    }
}
