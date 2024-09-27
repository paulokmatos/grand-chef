<?php

namespace App\Repositories;

use App\Models\Category;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository
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
        return Category::paginate(perPage:  $itemsPerPage, page: $page);
    }

    /**
     * @throws Exception
     */
    public function update(Category $category, array $attributes): Category
    {
        $updated = $category->update($attributes);

        if (!$updated) {
            throw new Exception('Failed to update category');
        }

        return $category;
    }

    /**
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $deleted = Category::destroy($id);

        if (!$deleted) {
            throw new Exception('Failed to update category');
        }
    }
}
