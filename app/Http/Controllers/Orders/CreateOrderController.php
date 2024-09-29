<?php

declare(strict_types=1);

namespace App\Http\Controllers\Orders;

use App\Actions\CreateOrder;
use App\DTOs\CreateOrderDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use OpenApi\Attributes as OA;

class CreateOrderController extends Controller
{
    #[OA\Post(
        path: '/api/orders',
        summary: 'Create a new order',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'products',
                        description: 'Array of products in the order',
                        type: 'array',
                        items: new OA\Items(
                            properties: [
                                new OA\Property(
                                    property: 'product_id',
                                    description: 'ID of the product',
                                    type: 'integer',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'price',
                                    description: 'Price of the product',
                                    type: 'number',
                                    format: 'float',
                                    example: 100.50
                                ),
                                new OA\Property(
                                    property: 'amount',
                                    description: 'Quantity of the product',
                                    type: 'integer',
                                    minimum: 1,
                                    example: 2
                                ),
                            ],
                            type: 'object'
                        )
                    ),
                ],
                type: 'object'
            )
        ),
        tags: ['Orders'],
        responses: [
            new OA\Response(
                response: 201,
                description: 'Order created successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'id', description: 'Order ID', type: 'integer'),
                        new OA\Property(property: 'products', description: 'Products in the order', type: 'array',
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(property: 'product_id', description: 'Product ID', type: 'integer'),
                                    new OA\Property(property: 'price', description: 'Product price', type: 'number', format: 'float'),
                                    new OA\Property(property: 'amount', description: 'Quantity of product', type: 'integer'),
                                ],
                                type: 'object'
                            )
                        ),
                        new OA\Property(property: 'total_price', description: 'Total price of the order', type: 'number', format: 'float'),
                    ],
                    type: 'object'
                )
            ),
            new OA\Response(response: 422, description: 'Validation error'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function __invoke(CreateOrderRequest $request): OrderResource
    {
        $createOrderDTO = CreateOrderDTO::fromArray($request->validated());

        $order = (new CreateOrder())->handle($createOrderDTO);

        return new OrderResource($order);
    }
}
