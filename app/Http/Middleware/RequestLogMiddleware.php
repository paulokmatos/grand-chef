<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;

class RequestLogMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate(Request $request, JsonResponse $response): void
    {
        Log::info($request->method().' Request', [
            'uri'           => $request->path(),
            'request_body'  => $request->getContent(),
            'request'       => $request->all(),
            'response_body' => $response->getContent(),
            'method'        => $request->method(),
            'ip'            => $request->ip(),
            'user_agent'    => $request->header('User-Agent'),
            'status_code'   => $response->getStatusCode(),
        ]);
    }
}
