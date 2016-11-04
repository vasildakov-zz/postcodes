<?php

namespace App\Container\Zend\Db;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Sql\Sql;

class SqlFactory
{
    /**
     * @param  ContainerInterface $container
     * @return PostcodeRepository
     */
    public function __invoke(ContainerInterface $container)
    {
        if (!$container->has(AdapterInterface::class)) {
            throw new \Exception("Error Processing Request");
        }

        $adapter = $container->get(AdapterInterface::class);

        return new Sql($adapter);
    }
}
