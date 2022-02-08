<?php

namespace Tests\Unit;

use App\Models\Product\Product;
use App\Models\Product\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductQuestionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_product()
    {
        $question = Question::factory()->create();

        $this->assertInstanceOf(Product::class, $question->product);
    }

    /** @test */
    public function it_has_a_path()
    {
        $question = Question::factory()->create();

        $this->assertEquals('/products/' . $question->product->id . '/questions/' . $question->id, $question->path());
    }

    /** @test */
    public function it_can_be_approved()
    {
        $question = Question::factory()->create();

        $this->assertFalse($question->approved);

        $question->approve();

        $this->assertTrue($question->fresh()->approved);
    }

    /** @test */
    public function it_can_be_disapproved()
    {
        $question = Question::factory(['approved' => true])->create();

        $this->assertTrue($question->approved);

        $question->disapprove();

        $this->assertFalse($question->fresh()->approved);
    }
}
