<?php

namespace Tests\Feature;

use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProductsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_products()
    {
        $product = Product::factory()->create();

        $this->get('/products')->assertRedirect('login');
        $this->get('/products/create')->assertRedirect('login');
        $this->get($product->path() . '/edit')->assertRedirect('login');
        $this->get($product->path())->assertRedirect('login');
        $this->post('/products', $product->toArray())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_add_a_product()
    {
        $this->signIn();

        $this->get('/products/create')->assertStatus(200);

        $this->followingRedirects()
            ->post('/products', $attributes = Product::factory()->raw())
            ->assertSee($attributes['brand'])
            ->assertSee($attributes['name'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['price']);
    }

    /** @test */
    public function a_user_can_update_a_product()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $this->patch($product->path(), $attributes = [
                    'brand' => 'New Brand',
                    'name' => 'New Name',
                    'description' => 'New Description',
                    'price' => 25.00
                ])
            ->assertRedirect($product->path());

        $this->get($product->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('products', $attributes);
    }

    /** @test */
    public function a_user_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $this->signIn(User::factory(['email' => env('ADMIN_EMAIL')])->create());

        $this->delete($product->path())
            ->assertRedirect('/products');

        $this->assertDatabaseMissing('products', $product->only('id'));
    }

    /** @test */
    public function unauthorized_users_cannot_delete_products()
    {
        $product = Product::factory()->create();

        $this->delete($product->path())
            ->assertRedirect('/login');

        $this->signIn();

        $this->delete($product->path())
            ->assertStatus(403);
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

        $attributes = Product::factory()->raw(['brand' => '']);

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
        $this->signIn();

        $product = Product::factory()->create();

        $this->get($product->path())
                ->assertSee($product->title)
                ->assertSee($product->brand)
                ->assertSee($product->description)
                ->assertSee($product->price);
    }
}
