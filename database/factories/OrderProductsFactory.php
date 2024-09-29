<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderProductsFactory extends Factory
{
    protected $model = OrderProducts::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'order_id'   => Order::factory(),
            'price'      => $this->faker->randomFloat(2, 1),
            'amount'     => $this->faker->randomNumber(2),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
