<?php

namespace CommonApi\Middleware;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class Middleware
{

    /**
     * Conteneur d'injection de dépendance
     *
     * @var Container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    abstract public function __invoke(Request $request, Response $response, callable $next) : Response;
}
