<?php

declare(strict_types=1);

namespace Tests\App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    public function test_ShouldListProducts(): void
    {
        Product::factory()->count(30)->create();

        $response = $this->getJson('api/products');

        $response->assertOk();
        $response->assertJson(fn (AssertableJson $json) => $json->has('data')
            ->has('links')
            ->has('current_page')
            ->where('per_page', 10)
            ->where('total', 30)
            ->etc()
        );
    }

    public function test_ShouldShowProduct()
    {
        $product = Product::factory()->create([
            'name'  => 'Product',
            'price' => 1000,
        ]);
        $response = $this->getJson('api/products/'.$product->id);

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->where('id', $product->id)
            ->where('name', 'Product')
            ->where('price', 1000)
            ->etc()
        );
    }

    public function test_ShouldCreateProduct()
    {
        $category = Category::factory()->create();

        $response = $this->postJson('api/products', [
            'name'        => 'Test Product',
            'category_id' => $category->id,
            'price'       => 100,
        ]);

        $response->assertCreated();
        $response->assertJson(
            fn (AssertableJson $json) => $json->where('name', 'Test Product')
            ->where('category_id', $category->id)
            ->where('price', 100)
            ->etc()
        );
        $this->assertDatabaseHas('products', [
            'name'        => 'Test Product',
            'category_id' => $category->id,
            'price'       => 100,
        ]);
    }

    public function test_ShouldUpdateProduct()
    {
        $category = Category::factory()->create([
            'name' => 'Planet',
        ]);

        $newCategory = Category::factory()->create([
            'name' => 'Asteroid',
        ]);

        $product = Product::factory()->create([
            'name'        => 'Pluto',
            'category_id' => $category->id,
            'price'       => 21.2,
        ]);

        $response = $this->putJson('api/products/'.$product->id, [
            'name'        => 'Updated Product',
            'category_id' => $newCategory->id,
            'price'       => 15,
        ]);

        $response->assertJson(
            fn (AssertableJson $json) => $json->where('name', 'Updated Product')
            ->where('price', 15)
            ->etc()
        );
    }

    public function test_ShouldDeleteProduct()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson('api/products/'.$product->id);

        $response->assertNoContent();
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $this->assertDatabaseCount('products', 0);
    }
}
