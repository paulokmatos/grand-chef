<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\IProductRepository;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements IProductRepository
{
    public function list(int $page, int $itemsPerPage): LengthAwarePaginator
    {
        return Product::paginate(perPage: $itemsPerPage, page: $page);
    }

    public function create(array $attributes): Product
    {
        return Product::create($attributes);
    }

    public function find(int $id): ?Product
    {
        return Product::firstWhere('id', $id);
    }

    public function delete(int $id): void
    {
        Product::destroy($id);
    }

    public function update(Product $product, array $attributes): Product
    {
        $product->update($attributes);

        return $product;
    }
}
