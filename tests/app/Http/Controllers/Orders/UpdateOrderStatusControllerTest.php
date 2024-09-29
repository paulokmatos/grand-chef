<?php

declare(strict_types=1);

namespace Tests\App\Http\Controllers\Orders;

use App\Enums\OrderStatus;
use App\Models\Order;
use Database\Seeders\OrderStatusSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UpdateOrderStatusControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        app(OrderStatusSeeder::class)->run();
    }

    public function test_ShouldUpdateOrderStatus()
    {
        $order = Order::factory()->create();

        $response = $this->patchJson('/api/orders/1/status', [
            'status_id' => OrderStatus::APPROVED->value,
        ]);

        $response->assertStatus(200)->assertJson(function (AssertableJson $json) {
            $json->where('data.status', 'approved')
                ->where('data.status_id', OrderStatus::APPROVED->value);
        });

        $this->assertDatabaseHas('orders', ['id' => $order->id, 'status_id' => OrderStatus::APPROVED->value]);
    }

    public function test_ShouldNotCancelAFinishedOrder()
    {
        Order::factory()->create([
            'id'        => 1,
            'status_id' => OrderStatus::FINISHED->value,
        ]);

        $response = $this->patchJson('/api/orders/1/status', [
            'status_id' => OrderStatus::CANCELLED->value,
        ]);

        $response->assertNotAcceptable()
        ->assertJson(function (AssertableJson $json) {
            $json->where('error', 'You cannot cancel an finished or canceled order');
        });
    }

    public function test_ShouldNotApproveACancelledOrder()
    {
        Order::factory()->create([
            'status_id' => OrderStatus::CANCELLED->value,
        ]);

        $response = $this->patchJson('/api/orders/1/status', [
            'status_id' => OrderStatus::APPROVED->value,
        ]);

        $response->assertNotAcceptable()
            ->assertJson(function (AssertableJson $json) {
                $json->where('error', 'You cannot approve a cancelled or a finished order');
            });
    }

    public function test_ShouldNotFinishACancelledOrder()
    {
        Order::factory()->create([
            'status_id' => OrderStatus::CANCELLED->value,
        ]);

        $response = $this->patchJson('/api/orders/1/status', [
            'status_id' => OrderStatus::FINISHED->value,
        ]);

        $response->assertNotAcceptable()
            ->assertJson(function (AssertableJson $json) {
                $json->where('error', 'You cannot finish a cancelled order');
            });
    }

    public function test_ShouldNotSetAOrderToPending()
    {
        Order::factory()->create([
            'status_id' => OrderStatus::APPROVED->value,
        ]);

        $response = $this->patchJson('/api/orders/1/status', [
            'status_id' => OrderStatus::PENDING->value,
        ]);

        $response->assertNotAcceptable()
            ->assertJson(function (AssertableJson $json) {
                $json->where('error', 'You cannot perform this action');
            });
    }
}
