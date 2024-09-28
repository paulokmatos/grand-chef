<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICategoryRepository
{
    public function create(array $attributes): Category;

    public function find(int $id): ?Category;

    public function list($page, $itemsPerPage): LengthAwarePaginator;

    public function update(Category $category, array $attributes): Category;

    public function delete(int $id): void;
}
