<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Validators\OrderStatusValidator;

class UpdateOrderStatus
{
    public function handle(Order $order, int $statusID): Order
    {
        app(OrderStatusValidator::class)->validate(OrderStatus::parseOrFail($statusID), $order);

        $order->status_id = $statusID;
        $order->save();

        return $order;
    }
}
