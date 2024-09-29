<?php

declare(strict_types=1);

namespace App\Http\Controllers\Menu;

use App\Actions\ListMenu;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListMenuResource;
use Exception;
use Illuminate\Http\Request;

class ListMenuController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(Request $request)
    {
        $itemsPerPage = $request->input('per_page', 10);
        $page         = $request->input('page', 1);

        return ListMenuResource::collection(app(ListMenu::class)->handle($page, $itemsPerPage));
    }
}
