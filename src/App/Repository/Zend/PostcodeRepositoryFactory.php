<?php

namespace App\Repository\Zend;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Hydrator\Reflection as Hydrator;
use Zend\ServiceManager\Factory\FactoryInterface;

use App\Entity\Postcode as Entity;

class PostcodeRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        if (!array_key_exists('db', $config)) {
            throw new \Exception("Database is not configured");
        }

        $adapter = new \Zend\Db\Adapter\Adapter($config['db']);

        return new PostcodeRepository($adapter, new Hydrator, new Entity);
    }
}
