<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

class ListMenu
{
    public function handle(int $page = 1, $itemsPerPage = 10): LengthAwarePaginator
    {
        return Category::with('products:id,name,price,category_id')->paginate(perPage: $itemsPerPage, page: $page);
    }
}
