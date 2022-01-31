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

        $attributes = ProductReview::factory()->raw();

        $this->post($product->path() . '/reviews', $attributes);

        $this->assertDatabaseHas('product_reviews', $attributes);

        $this->get($product->path())->assertSee($attributes['body']);
    }
}
