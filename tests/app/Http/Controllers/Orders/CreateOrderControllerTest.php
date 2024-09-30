<?php

declare(strict_types=1);

namespace Tests\App\Http\Controllers\Orders;

use App\Models\Product;
use Database\Seeders\OrderStatusSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CreateOrderControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        app(OrderStatusSeeder::class)->run();
    }

    public function test_ShouldCreateANewOrder()
    {
        $products = Product::factory(3)->create();

        $response = $this->postJson('/api/orders', [
            'products' => [
                [
                    'product_id' => $products[0]->id,
                    'price'      => 20,
                    'amount'     => 10,
                ],
                [
                    'product_id' => $products[1]->id,
                    'price'      => 10,
                    'amount'     => 10,
                ],
            ],
        ]);

        $this->assertDatabaseHas('orders', [
            'total_price' => 300,
        ]);

        $response->assertCreated()
            ->assertJson(function (AssertableJson $json) use ($products, $response) {
                $json->has('data.products')
                    ->where('data.total_price', 300)
                    ->where('data.products.1.product_id', $products[1]->id)
                    ->where('data.products.0.product_id', $products[0]->id)
                    ->where('data.products.0.order_id', $response->json('data.id'))
                    ->where('data.products.0.product_name', $products[0]->name)
                    ->where('data.products.0.price', 20)
                    ->where('data.products.0.amount', 10);
            });
    }
}
