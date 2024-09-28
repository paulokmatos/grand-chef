<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface IProductRepository
{
    public function list(int $page, int $itemsPerPage): LengthAwarePaginator;

    public function create(array $attributes): Product;

    public function find(int $id): ?Product;

    public function delete(int $id): void;

    public function update(Product $product, array $attributes): Product;
}
