<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\CreateOrderDTO;
use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderProducts;

class CreateOrder
{
    public function handle(CreateOrderDTO $createOrderDTO): Order
    {
        $totalPrice    = 0;
        $ordersProduct = [];
        $order         = Order::create([
            'status_id' => OrderStatus::PENDING->value,
        ]);

        foreach ($createOrderDTO->products as $product) {
            $totalPrice += $product->price * $product->amount;

            $ordersProduct[] = new OrderProducts([
                'order_id'   => $order->id,
                'product_id' => $product->productId,
                'price'      => $product->price,
                'amount'     => $product->amount,
            ]);
        }

        $order->products()->saveMany($ordersProduct);
        $order->total_price = $totalPrice;
        $order->save();

        return $order->load('products');
    }
}
