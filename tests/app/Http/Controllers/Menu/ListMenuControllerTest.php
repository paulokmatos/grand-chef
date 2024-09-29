<?php

declare(strict_types=1);

namespace Tests\App\Http\Controllers\Menu;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ListMenuControllerTest extends TestCase
{
    public function test_ShouldListPaginatedMenuItems()
    {
        $category = Category::factory()->create([
            'name' => 'Fast Food',
        ]);

        $product = Product::factory()->create([
            'category_id' => $category->id,
            'name'        => 'Hamburger',
            'price'       => 10,
        ]);

        $response = $this->getJson('/api/menu');

        $response->assertStatus(200)->assertJson(function (AssertableJson $json) use ($category, $product) {
            $json->has('meta.current_page')
                ->has('meta.links')
                ->where('meta.per_page', 10)
                ->where('meta.total', 1)
                ->where('data.0.id', $category->id)
                ->where('data.0.name', 'Fast Food')
                ->where('data.0.products.0.name', 'Hamburger')
                ->where('data.0.products.0.id', $product->id)
                ->where('data.0.products.0.price', 10)
                ->etc();
        });
    }
}
