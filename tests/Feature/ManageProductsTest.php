<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProductsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function only_authenticated_users_can_manage_products()
    {
        $product = Product::factory()->create();

        $this->get('/products')->assertRedirect('login');
        $this->get('/products/create')->assertRedirect('login');
        $this->get($product->path())->assertRedirect('login');
        $this->post('/products', $product->toArray())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_add_a_product()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get('/products/create')->assertStatus(200);

        $attributes = Product::factory()->raw();

        $this->post('/products', $attributes)->assertRedirect('/products');

        $this->assertDatabaseHas('products', $attributes);

        $this->get('/products')->assertSee($attributes['name']);
    }

    /** @test */
    public function a_product_requires_a_name()
    {
        $this->signIn();

        $attributes = Product::factory()->raw(['name' => '']);

        $this->post('/products', $attributes)->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_product_requires_a_brand()
    {
        $this->signIn();

        $attributes = Product::factory()->raw(['brand' => null]);

        $this->post('/products', $attributes)->assertSessionHasErrors('brand');
    }

    /** @test */
    public function a_product_requires_a_description()
    {
        $this->signIn();

        $attributes = Product::factory()->raw(['description' => '']);

        $this->post('/products', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_product_requires_a_price()
    {
        $this->signIn();

        $attributes = Product::factory()->raw(['price' => null]);

        $this->post('/products', $attributes)->assertSessionHasErrors('price');
    }

    /** @test */
    public function a_user_can_view_a_single_product()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $product = Product::factory()->create();

        $this->get($product->path())
                ->assertSee($product->title)
                ->assertSee($product->brand)
                ->assertSee($product->description)
                ->assertSee($product->price);
    }
}
