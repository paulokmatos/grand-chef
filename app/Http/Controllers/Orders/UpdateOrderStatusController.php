<?php

declare(strict_types=1);

namespace App\Http\Controllers\Orders;

use App\Actions\UpdateOrderStatus;
use App\Enums\OrderStatus;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Validators\OrderStatusValidator;
use Exception;
use Illuminate\Http\JsonResponse;

class UpdateOrderStatusController
{
    /**
     * @throws Exception
     */
    public function __invoke(UpdateOrderStatusRequest $request, Order $order): JsonResponse|OrderResource
    {
        $statusID = $request->input('status_id');

        app(OrderStatusValidator::class)->validate(OrderStatus::parseOrFail($statusID), $order);

        $updatedOrder = app(UpdateOrderStatus::class)->handle($order, $statusID);

        return new OrderResource($updatedOrder);
    }
}
