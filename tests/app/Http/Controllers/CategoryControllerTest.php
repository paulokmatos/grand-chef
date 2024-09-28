<?php

declare(strict_types=1);

namespace Tests\App\Http\Controllers;

use App\Models\Category;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    public function test_ShouldCreateCategory()
    {
        $response = $this->postJson('/api/categories', [
            'name' => 'Test Category',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('categories', ['id' => 1, 'name' => 'Test Category']);
    }

    public function test_ShouldDestroyCategory()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson('/api/categories/'.$category->id);

        $response->assertNoContent();
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
        $this->assertDatabaseCount('categories', 0);
    }

    public function test_ShouldUpdateCategory()
    {
        $category = Category::factory()->create();

        $response = $this->putJson('/api/categories/'.$category->id, ['name' => 'New Category Name']);

        $response->assertOk();
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'New Category Name']);
    }

    public function test_ShouldGetAllCategories()
    {
        $category = Category::factory(3)->create();

        $response = $this->getJson('/api/categories');

        $this->assertJson($response->getContent());
        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('current_page')
                ->has('data')
                ->has('links')
                ->has(
                    'data.0',
                    fn (AssertableJson $json) => $json->where('id', $category[0]->id)
                        ->where('name', $category[0]->name)
                        ->etc()
                )->etc()
        );
    }

    public function test_ShouldShowCategory()
    {
        $category = Category::factory()->create();

        $response = $this->getJson('/api/categories/'.$category->id);

        $this->assertJson($response->getContent(), json_encode($category->toArray()));
        $response->assertOk();
        $response->assertJson(fn (AssertableJson $json) => $json->where('id', $category->id)
            ->where('name', $category->name)
            ->etc());
    }
}
