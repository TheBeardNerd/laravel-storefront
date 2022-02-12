<?php

namespace Tests\Unit;

use App\Models\Product\Product;
use App\Models\Product\Question;
use App\Models\Product\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $product = Product::factory()->create();

        $this->assertEquals('/products/' . $product->id, $product->path());
    }

    /** @test */
    public function it_has_a_creator()
    {
        $product = Product::factory()->create();

        $this->assertInstanceOf(User::class, $product->creator);
    }

    /** @test */
    public function it_can_add_a_review()
    {
        $product = Product::factory()->create();

        $attributes = Review::factory()->raw();

        $review = $product->addReview($attributes);

        $this->assertCount(1, $product->reviews);

        $this->assertTrue($product->reviews->contains($review));
    }

    /** @test */
    public function it_can_add_a_question()
    {
        $product = Product::factory()->create();

        $attributes = Question::factory()->raw();

        $review = $product->addQuestion($attributes);

        $this->assertCount(1, $product->questions);

        $this->assertTrue($product->questions->contains($review));
    }
}
