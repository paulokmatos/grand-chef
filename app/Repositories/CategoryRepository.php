<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\ICategoryRepository;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository implements ICategoryRepository
{
    public function create(array $attributes): Category
    {
        return Category::create($attributes);
    }

    public function find(int $id): ?Category
    {
        return Category::firstWhere('id', $id);
    }

    public function list($page, $itemsPerPage): LengthAwarePaginator
    {
        return Category::paginate(perPage: $itemsPerPage, page: $page);
    }

    public function update(Category $category, array $attributes): Category
    {
        $category->update($attributes);

        return $category;
    }

    public function delete(int $id): void
    {
        Category::destroy($id);
    }
}
