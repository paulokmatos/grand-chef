<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Order;

class UpdateOrderStatus
{
    public function handle(Order $order, int $statusID): Order
    {
        $order->status_id = $statusID;
        $order->save();

        return $order;
    }
}
