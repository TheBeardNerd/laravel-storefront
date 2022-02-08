<?php

namespace Tests\Unit;

use App\Models\Product\Product;
use App\Models\Product\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductReviewTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_product()
    {
        $review = Review::factory()->create();

        $this->assertInstanceOf(Product::class, $review->product);
    }

    /** @test */
    public function it_has_a_path()
    {
        $review = Review::factory()->create();

        $this->assertEquals('/products/' . $review->product->id . '/reviews/' . $review->id, $review->path());
    }

    /** @test */
    public function it_can_be_approved()
    {
        $review = Review::factory()->create();

        $this->assertFalse($review->approved);

        $review->approve();

        $this->assertTrue($review->fresh()->approved);
    }

    /** @test */
    public function it_can_be_disapproved()
    {
        $review = Review::factory(['approved' => true])->create();

        $this->assertTrue($review->approved);

        $review->disapprove();

        $this->assertFalse($review->fresh()->approved);
    }
}
