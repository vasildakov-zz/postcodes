<?php

namespace App\Repository\Zend;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class PostcodeRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $adapter = new \Zend\Db\Adapter\Adapter([
            'driver'   => 'Pdo_Mysql',
            'database' => 'postcodes',
            'username' => 'root',
            'password' => '1',
        ]);

        return new PostcodeRepository($adapter);
    }
}
