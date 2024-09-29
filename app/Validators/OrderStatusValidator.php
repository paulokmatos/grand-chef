<?php

declare(strict_types=1);

namespace App\Validators;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\ValidateOrderStatus\IOrderStatusValidator;
use App\ValidateOrderStatus\OrderStatusApprovedValidator;
use App\ValidateOrderStatus\OrderStatusCancelledValidator;
use App\ValidateOrderStatus\OrderStatusFinishedValidator;
use App\ValidateOrderStatus\OrderStatusPendingValidator;

class OrderStatusValidator
{
    public function validate(OrderStatus $status, Order $order): void
    {
        $validator = $this->getValidator($status);

        $validator->validate($order);
    }

    private function getValidator(OrderStatus $status): IOrderStatusValidator
    {
        return match ($status) {
            OrderStatus::CANCELLED => new OrderStatusCancelledValidator(),
            OrderStatus::APPROVED  => new OrderStatusApprovedValidator(),
            OrderStatus::FINISHED  => new OrderStatusFinishedValidator(),
            OrderStatus::PENDING   => new OrderStatusPendingValidator()
        };
    }
}
