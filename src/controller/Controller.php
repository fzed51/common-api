<?php


namespace CommonApi\Controller;

use Slim\Container;
use Slim\Http\Request;

abstract class Controller
{
    /**
     * conteneur pour l'injection de dépendance
     * @var Container
     */
    protected $container;

    /**
     * constructeur
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * lit les paramètres de requète
     * @param Request $request
     * @return array
     */
    protected function readQueryParams(Request $request): array
    {
        return $request->getQueryParams();
    }

    /**
     * lit les données
     * @param Request $request
     * @return null|object|array
     */
    protected function readBody(Request $request)
    {
        return $request->getParsedBody();
    }
}
