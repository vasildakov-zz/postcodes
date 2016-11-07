<?php

namespace Infrastructure;

use Infrastructure\Repository\Zend;
use Infrastructure\Repository\Pdo;
use Infrastructure\Repository\Doctrine;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => [

                'invokables' => [],

                'factories' => [
                    // Cache

                    // Logger

                    // Repository
                    Doctrine\PostcodeRepository::class => Doctrine\PostcodeRepositoryFactory::class,
                    Pdo\PostcodeRepository::class => Pdo\PostcodeRepositoryFactory::class,
                    Zend\PostcodeRepository::class => Zend\PostcodeRepositoryFactory::class,
                ],
            ]
        ];
    }
}
