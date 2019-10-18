<?php

declare(strict_types=1);

namespace CommonApi;

class ConfigToPdoFactory
{
    /**
     * 
     */
    private static function testStructure(array $schema, array $structure)
    {
        $inKey = array_keys($structure);
        return array_reduce($schema, function (bool $r, string $k) use ($inKey) {
            return $r && in_array($k, $inKey);
        }, true);
    }

    /**
     * retourne une instance PDO en fonction d'une config
     * @param array $config - contient 'provider','name','host','port','user','pass' et'charset'
     * @return \PDO
     */
    public static function getPdo(array $config): \PDO
    {
        // test de la config
        $ctrl = [
            'provider',
            'name',
            'host',
            'port',
            'user',
            'pass',
            'charset'
        ];
        if (!self::testStructure($ctrl, $config)) {
            throw new Exception\BadConfigException("La configuration de la base de donnée doit contenir "
                . implode(', ', $ctrl) . " même si ils sont vide.");
        }
        switch ($config['provider']) {
            case 'sqlite':
                return \Helper\PDOFactory::sqlite($config['name']);
            case 'pgsql':
                return \Helper\PDOFactory::pgsql($config['name'], $config['host'], $config['user'], $config['pass']);
            case 'oci':
                return \Helper\PDOFactory::oci($config['name'], $config['user'], $config['pass'], $config['charset']);
            case 'mysql':
                return \Helper\PDOFactory::mysql(
                    $config['host'],
                    $config['name'],
                    $config['user'],
                    $config['pass'],
                    $config['port'],
                    $config['charset']
                );
        }

        throw new \RuntimeException("Le provider {$config['provider']} n'est pas pris en compte");
    }
}
