<?php

declare(strict_types=1);

namespace CommonApi;

use Slim\Container;
use RuntimeException;

/**
 * Class App
 * @package CommonApi
 */
abstract class App extends \Slim\App
{
    /**
     * App constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct(['config' => $this->getConfig($config)]);
        $container = $this->getContainer();
        $container['resolve'] = static function (Container $c) {
            return new \InstanceResolver\ResolverClass($c);
        };
        $this->setDependencies($container);
        $this->setHandlers($container);
        $this->setMiddleware($this);
    }

    protected function getConfig(array $config = []): array
    {
        return $config;
    }

    /**
     * Méthode pour ajouter des éléments au container
     * @param \Slim\Container $container
     */
    protected function setDependencies(Container $container): void
    { }

    /**
     * Méthode pour ajouter des handler à l'application
     * @param \Slim\Container $container
     */
    protected function setHandlers(Container $container): void
    {
        $container['errorHandler'] = static function (container $c) {
            return static function ($request, $response, Throwable $exception) use ($c) {
                /** @var ResponseFormatterInterface $formatter */
                $formatter = $c->get(ResponseFormatterInterface::class);
                $code = ($exception->getCode() >= 100 && $exception->getCode() < 600)
                    ? $exception->getCode()
                    : 500;
                $message = ($exception->getCode() >= 100 && $exception->getCode() < 600)
                    ? $exception->getMessage()
                    : 'Erreur interne';
                error_log(json_encode([
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'code' => $exception->getCode(),
                    'trace' => $exception->getTrace()
                ]));
                return $formatter->error($response, $code, $message);
            };
        };

        $container['notFoundHandler'] = static function (container $c) {
            return static function ($request, $response) use ($c) {
                /** @var ResponseFormatterInterface $formatter */
                $formatter = $c->get(ResponseFormatterInterface::class);
                return $formatter->error($response, 404, 'Ressource non trouvée');
            };
        };
    }

    /**
     * Méthode pour ajouter des middleware à l'application
     * @param \Slim\App $app
     */
    protected function setMiddleware(\Slim\App $app): void
    { }

    /**
     * Enregistre un module
     * @param string $module - module à ajouter à l'application
     * @param string $baseUrl - url de base pour le module
     */
    final protected function register(string $module, string $baseUrl = ''): void
    {
        if (is_a($module, ModuleInterface::class, true)) {
            // netoyage de l'url de base
            $baseUrl = '/' . trim($baseUrl, '/');
            $module::registerMe($this, $baseUrl);
        } else {
            throw new RuntimeException(
                "Vous tentez d'enregistrer un '$module' qui n'est pas un ModuleInterface"
            );
        }
    }
}
