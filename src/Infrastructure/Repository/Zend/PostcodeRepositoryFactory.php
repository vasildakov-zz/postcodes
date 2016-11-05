<?php

namespace Infrastructure\Repository\Zend;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;

use Zend\Hydrator\Reflection as ReflectionHydrator;
use Zend\ServiceManager\Factory\FactoryInterface;

use Domain\Entity\Postcode;

class PostcodeRepositoryFactory implements FactoryInterface
{
    /**
     * @param  ContainerInterface $container
     * @return PostcodeRepository
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');

        if (!array_key_exists('db', $config)) {
            throw new \Exception("Database is not configured");
        }

        $adapter = new \Zend\Db\Adapter\Adapter($config['db']);

        $resultSetPrototype = new HydratingResultSet(
            new ReflectionHydrator(),
            new Postcode(null, null, null, null)
        );

        $tableGateway = new TableGateway('postcode', $adapter, null, $resultSetPrototype);

        return new PostcodeRepository($tableGateway);
    }
}
