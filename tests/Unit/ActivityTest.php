<?php

namespace Tests\Unit;

use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_user()
    {
        $user = $this->signIn();

        $product = Product::factory(['creator_id' => $user->id])->create();

        $this->assertEquals($user->id, $product->activity->first()->user->id);
    }
}
