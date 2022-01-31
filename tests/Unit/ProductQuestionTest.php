<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ProductQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductQuestionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_product()
    {
        $question = ProductQuestion::factory()->create();

        $this->assertInstanceOf(Product::class, $question->product);
    }

    /** @test */
    public function it_has_a_path()
    {
        $question = ProductQuestion::factory()->create();

        $this->assertEquals('/products/' . $question->product->id . '/questions/' . $question->id, $question->path());
    }
}
