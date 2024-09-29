<?php

declare(strict_types=1);

namespace App\ValidateOrderStatus;

use App\Exceptions\InvalidStatusException;
use App\Models\Order;
use Exception;

class OrderStatusPendingValidator implements IOrderStatusValidator
{
    /**
     * @throws Exception
     */
    public function validate(Order $order): void
    {
        throw new InvalidStatusException('You cannot perform this action');
    }
}
