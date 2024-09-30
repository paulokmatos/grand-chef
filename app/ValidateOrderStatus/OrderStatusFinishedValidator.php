<?php

declare(strict_types=1);

namespace App\ValidateOrderStatus;

use App\Enums\OrderStatus;
use App\Exceptions\InvalidStatusException;
use App\Models\Order;
use Exception;

class OrderStatusFinishedValidator implements IOrderStatusValidator
{
    /**
     * @throws Exception
     */
    public function validate(Order $order): void
    {
        if ($order->status_id === OrderStatus::CANCELLED->value) {
            throw new InvalidStatusException('You cannot finish a cancelled order');
        }
    }
}
