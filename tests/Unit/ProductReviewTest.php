<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductReviewTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_product()
    {
        $review = ProductReview::factory()->create();

        $this->assertInstanceOf(Product::class, $review->product);
    }

    /** @test */
    public function it_has_a_path()
    {
        $review = ProductReview::factory()->create();

        $this->assertEquals('/products/' . $review->product->id . '/reviews/' . $review->id, $review->path());
    }
}
