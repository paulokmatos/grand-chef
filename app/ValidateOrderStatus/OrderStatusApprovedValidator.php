<?php

declare(strict_types=1);

namespace App\ValidateOrderStatus;

use App\Enums\OrderStatus;
use App\Exceptions\InvalidStatusException;
use App\Models\Order;
use Exception;

class OrderStatusApprovedValidator implements IOrderStatusValidator
{
    /**
     * @throws Exception
     */
    public function validate(Order $order): void
    {
        $notAllowedStatuses = [
            OrderStatus::CANCELLED->value,
            OrderStatus::FINISHED->value,
        ];

        if (in_array($order->status_id, $notAllowedStatuses, true)) {
            throw new InvalidStatusException('You cannot approve a cancelled or a finished order');
        }
    }
}
