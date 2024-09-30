<?php

declare(strict_types=1);

namespace App\Http\Controllers\Orders;

use App\Actions\UpdateOrderStatus;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Exception;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class UpdateOrderStatusController
{
    /**
     * @throws Exception
     */
    #[OA\Put(
        path: '/api/orders/{id}/status',
        summary: 'Update order status',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'status_id',
                        description: 'New status of the order (2: Approved, 3: Finished, 4: Cancelled)',
                        type: 'integer',
                        enum: [1, 2, 3, 4],
                        example: 2
                    ),
                ],
                type: 'object'
            )
        ),
        tags: ['Orders'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'Order ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Order status updated successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'id', description: 'Order ID', type: 'integer'),
                        new OA\Property(property: 'status_id', description: 'Updated status ID', type: 'integer'),
                    ],
                    type: 'object'
                )
            ),
            new OA\Response(
                response: 400,
                description: 'Validation error',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            description: 'Error message',
                            type: 'string',
                            example: 'Status ID must be one of 2: Approved, 3: Finished, 4: Cancelled'
                        ),
                    ],
                    type: 'object'
                )
            ),
            new OA\Response(response: 404, description: 'Order not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function __invoke(UpdateOrderStatusRequest $request, Order $order): JsonResponse|OrderResource
    {
        $statusID = $request->input('status_id');

        $updatedOrder = app(UpdateOrderStatus::class)->handle($order, $statusID);

        return new OrderResource($updatedOrder);
    }
}
