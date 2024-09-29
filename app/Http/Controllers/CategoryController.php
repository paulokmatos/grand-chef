<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Interfaces\ICategoryRepository;
use App\Models\Category;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class CategoryController extends Controller
{
    public function __construct(protected ICategoryRepository $repository)
    {
    }

    #[OA\Get(
        path: '/api/categories',
        summary: 'List categories',
        tags: ['Categories'],
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
                description: 'Number of items per page',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer', default: 10)
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Categories retrieved successfully',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'id', description: 'Category ID', type: 'integer'),
                            new OA\Property(property: 'name', description: 'Category name', type: 'string'),
                        ],
                        type: 'object'
                    )
                )
            ),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function index(Request $request)
    {
        $list = $this->repository->list(
            page: $request->get('page', 1),
            itemsPerPage: $request->get('per_page', 10)
        );

        return response()->json($list);
    }

    #[OA\Post(
        path: '/api/categories',
        summary: 'Create a new category',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', description: 'Category name', type: 'string', example: 'Fast Food'),
                ],
                type: 'object'
            )
        ),
        tags: ['Categories'],
        responses: [
            new OA\Response(
                response: 201,
                description: 'Category created successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'id', description: 'Category ID', type: 'integer'),
                        new OA\Property(property: 'name', description: 'Category name', type: 'string'),
                    ],
                    type: 'object'
                )
            ),
            new OA\Response(response: 422, description: 'Validation error'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function store(CreateCategoryRequest $request)
    {
        return $this->repository->create($request->validated());
    }

    #[OA\Get(
        path: '/api/categories/{id}',
        summary: 'Retrieve a category by ID',
        tags: ['Categories'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'Category ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Category retrieved successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'id', description: 'Category ID', type: 'integer'),
                        new OA\Property(property: 'name', description: 'Category name', type: 'string'),
                    ],
                    type: 'object'
                )
            ),
            new OA\Response(response: 404, description: 'Category not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function show(Category $category)
    {
        return $this->repository->find($category->id);
    }

    #[OA\Put(
        path: '/api/categories/{id}',
        summary: 'Update a category',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', description: 'Category name', type: 'string', example: 'Beverages'),
                ],
                type: 'object'
            )
        ),
        tags: ['Categories'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'Category ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Category updated successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'id', description: 'Category ID', type: 'integer'),
                        new OA\Property(property: 'name', description: 'Category name', type: 'string'),
                    ],
                    type: 'object'
                )
            ),
            new OA\Response(response: 404, description: 'Category not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        return $this->repository->update(category: $category, attributes: $request->all());
    }

    #[OA\Delete(
        path: '/api/categories/{id}',
        summary: 'Delete a category',
        tags: ['Categories'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'Category ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Category deleted successfully'),
            new OA\Response(response: 404, description: 'Category not found'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
    public function destroy(Category $category)
    {
        $this->repository->delete($category->id);

        return response()->json()->setStatusCode(204);
    }
}
