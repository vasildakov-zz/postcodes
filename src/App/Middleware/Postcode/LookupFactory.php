<?php

namespace App\Middleware\Postcode;

use App\Entity;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Doctrine\ORM\EntityManager;

class LookupFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $em = $container->get(EntityManager::class);
        $repository = $em->getRepository(Entity\Postcode::class);

        $filter = $container->get(\App\Filter\Postcode::class);

        return new LookupAction($repository, $filter);
    }
}
