<?php

declare(strict_types=1);

namespace App\Http\Controllers\Orders;

use App\Actions\CreateOrder;
use App\DTOs\CreateOrderDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;

class CreateOrderController extends Controller
{
    public function __invoke(CreateOrderRequest $request): OrderResource
    {
        $createOrderDTO = CreateOrderDTO::fromArray($request->validated());

        $order = (new CreateOrder())->handle($createOrderDTO);

        return new OrderResource($order);
    }
}
