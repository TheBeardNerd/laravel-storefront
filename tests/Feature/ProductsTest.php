<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_add_a_product()
    {
        $this->withoutExceptionHandling();

        $attributes = Product::factory()->raw();

        $this->post('/products', $attributes)->assertRedirect('/products');

        $this->assertDatabaseHas('products', $attributes);

        $this->get('/products', $attributes)->assertSee($attributes['name']);
    }

    /** @test */
    public function a_product_requires_a_name()
    {
        $attributes = Product::factory()->raw(['name' => '']);

        $this->post('/products', $attributes)->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_product_requires_a_description()
    {
        $attributes = Product::factory()->raw(['description' => '']);

        $this->post('/products', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_product_requires_a_price()
    {
        $attributes = Product::factory()->raw(['price' => null]);

        $this->post('/products', $attributes)->assertSessionHasErrors('price');
    }

    /** @test */
    public function a_user_can_view_a_product()
    {
        $this->withoutExceptionHandling();

        $product = Product::factory()->create();

        $this->get($product->path())
                ->assertSee($product->title)
                ->assertSee($product->description)
                ->assertSee($product->price);


    }
}
