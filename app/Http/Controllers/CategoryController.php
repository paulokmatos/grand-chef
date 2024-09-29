<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Interfaces\ICategoryRepository;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(protected ICategoryRepository $repository)
    {
    }

    public function index(Request $request)
    {
        $list = $this->repository->list(
            page: $request->get('page', 1),
            itemsPerPage: $request->get('per_page', 10)
        );

        return response()->json($list);
    }

    public function store(CreateCategoryRequest $request)
    {
        return $this->repository->create($request->validated());
    }

    public function show(Category $category)
    {
        return $this->repository->find($category->id);
    }

    /**
     * @throws Exception
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        return $this->repository->update(category: $category, attributes: $request->all());
    }

    /**
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        $this->repository->delete($category->id);

        return response()->json()->setStatusCode(204);
    }
}
