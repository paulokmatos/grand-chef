<?php

declare(strict_types=1);

namespace App\ValidateOrderStatus;

use App\Models\Order;

interface IOrderStatusValidator
{
    public function validate(Order $order): void;
}
