<?php

namespace CommonApi\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class CorsMiddleware extends Middleware
{
    public function __invoke(Request $request, Response $response, callable $next) : Response
    {
        $response = $next($request, $response);

        return $response
            ->withHeader("Access-Control-Allow-Origin", "*")
            ->withHeader("Access-Control-Allow-Headers", "Content-Type, X-TOKEN")
            ->withHeader("Access-Control-Allow-Method", "POST, GET, OPTIONS");
    }
}
