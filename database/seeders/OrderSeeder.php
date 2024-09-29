<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProducts;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory()->count(3)
            ->create()
            ->each(function (Order $order) {
                OrderProducts::factory()
                    ->count(3)
                    ->create(['order_id' => $order->id]);
            });
    }
}
