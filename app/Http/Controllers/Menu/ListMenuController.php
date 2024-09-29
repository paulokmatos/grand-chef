<?php

declare(strict_types=1);

namespace App\Http\Controllers\Menu;

use App\Actions\ListMenu;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListMenuResource;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class ListMenuController extends Controller
{
    #[OA\Get(
        path: '/api/menu',
        summary: 'List all Categories with products',
        tags: ['List Menu'],
        parameters: [
            new OA\Parameter(
                name: 'per_page',
                description: 'Items per page',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer', default: 10)
            ),
            new OA\Parameter(
                name: 'page',
                description: 'Page number',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer', default: 1)
            ),
        ],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: 'Users retrieved successfully'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function __invoke(Request $request)
    {
        $itemsPerPage = $request->input('per_page', 10);
        $page         = $request->input('page', 1);

        return ListMenuResource::collection(app(ListMenu::class)->handle($page, $itemsPerPage));
    }
}
