<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Interfaces\IProductRepository;
use App\Models\Product;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ProductController extends Controller
{
    public function __construct(
        private readonly IProductRepository $repository
    ) {
    }

    #[OA\Get(
        path: '/api/products',
        summary: 'List all products',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'page',
                description: 'Page number',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer', default: 1)
            ),
            new OA\Parameter(
                name: 'per_page',
                description: 'Items per page',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer', default: 10)
            ),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Product list retrieved successfully'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function index(Request $request)
    {
        return $this->repository->list(
            page: $request->input('page', 1),
            itemsPerPage:  $request->input('per_page', 10)
        );
    }

    #[OA\Post(
        path: '/api/products',
        summary: 'Create a new product',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'price', 'category_id'],
                properties: [
                    new OA\Property(property: 'name', description: 'Product name', type: 'string'),
                    new OA\Property(property: 'price', description: 'Product price', type: 'number', format: 'float'),
                    new OA\Property(property: 'category_id', description: 'Category ID', type: 'integer'),
                ]
            )
        ),
        tags: ['Products'],
        responses: [
            new OA\Response(response: 201, description: 'Product created successfully'),
            new OA\Response(response: 422, description: 'Validation error'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function store(CreateProductRequest $request)
    {
        return $this->repository->create($request->validated());
    }

    #[OA\Get(
        path: '/api/products/{id}',
        summary: 'Retrieve a specific product',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'Product ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Product retrieved successfully'),
            new OA\Response(response: 404, description: 'Product not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function show(int $id)
    {
        return $this->repository->find($id);
    }

    #[OA\Put(
        path: '/api/products/{id}',
        summary: 'Update a specific product',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'price', 'category_id'],
                properties: [
                    new OA\Property(property: 'name', description: 'Product name', type: 'string'),
                    new OA\Property(property: 'price', description: 'Product price', type: 'number', format: 'float'),
                    new OA\Property(property: 'category_id', description: 'Category ID', type: 'integer'),
                ]
            )
        ),
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'Product ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Product updated successfully'),
            new OA\Response(response: 404, description: 'Product not found'),
            new OA\Response(response: 422, description: 'Validation error'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->repository->update($product, $request->validated());

        return $product;
    }

    #[OA\Delete(
        path: '/api/products/{id}',
        summary: 'Delete a specific product',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'Product ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Product deleted successfully'),
            new OA\Response(response: 404, description: 'Product not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function destroy(int $id)
    {
        $this->repository->delete($id);

        return response()->json()->setStatusCode(204);
    }
}
