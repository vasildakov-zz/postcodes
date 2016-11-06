<?php

namespace Infrastructure\Repository\Pdo;

use Interop\Container\ContainerInterface;

class PostcodeRepositoryFactory
{
    /**
     * @param  ContainerInterface $container
     * @return PostcodeRepository
     */
    public function __invoke(ContainerInterface $container)
    {
        if (!extension_loaded('pdo') || !class_exists('PDO')) {
            throw new \Exception("PDO extension is not loaded");
        }

        $config = $container->get('config');

        if (!array_key_exists('db', $config)) {
            throw new \Exception("Database is not configured");
        }

        $connection = new \PDO(
            $config['db']['dsn'],
            $config['db']['username'],
            $config['db']['password']
        );

        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return new PostcodeRepository($connection);
    }
}
