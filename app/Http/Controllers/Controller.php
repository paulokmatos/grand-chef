<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[
    OA\PathItem('/api'),
    OA\Info(version: '1.0.0', description: 'Grand Chef Api Documentation', title: 'Grand Chef Api'),
    OA\Header('Accept', 'application/json'),
]
abstract class Controller
{
    //
}
