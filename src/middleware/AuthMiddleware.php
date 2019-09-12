<?php

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Domaine\Query\UserIsConnected;

class AuthMiddleware extends Middleware
{
    public function __invoke(Request $request, Response $response, callable $next) : Response
    {
        
        $pdo = $this->container->get(\PDO::class);
        $token = $request->getHeaderLine('X-TOKEN');
        $user = (new UserIsConnected($pdo, $token))();
        $request = $request->withAttribute(
            'user',
            $user
        );
        return $next($request, $response);
    }
}
