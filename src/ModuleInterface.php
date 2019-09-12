<?php
declare(strict_types=1);

namespace CommonApi;

/**
 * Interface ModuleInterface
 * @package CommonApi
 */
interface ModuleInterface
{
    public static function registerMe(App $app, string $baseUrl);
}
