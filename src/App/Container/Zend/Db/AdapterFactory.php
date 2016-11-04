<?php

namespace App\Container\Zend\Db;

use Zend\Db\Adapter\Adapter;

class AdapterFactory
{
    /**
     * @param  ContainerInterface $container
     * @return PostcodeRepository
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        if (!array_key_exists('db', $config)) {
            throw new \Exception("Database is not configured");
        }

        return new Adapter($config['db']);
    }
}
