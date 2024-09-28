<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Interfaces\IProductRepository;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private readonly IProductRepository $repository
    ) {
    }

    public function index(Request $request)
    {
        return $this->repository->list(
            page: $request->input('page', 1),
            itemsPerPage:  $request->input('per_page', 10)
        );
    }

    public function store(CreateProductRequest $request)
    {
        return $this->repository->create($request->validated());
    }

    public function show(int $id)
    {
        return $this->repository->find($id);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->repository->update($product, $request->validated());

        return $product;
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);

        return response()->json()->setStatusCode(204);
    }
}
