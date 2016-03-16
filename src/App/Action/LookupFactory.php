<?php

namespace App\Action;

use App\Entity;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;

class LookupFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $em = $container->get('Doctrine\ORM\EntityManager');
        $repository = $em->getRepository(Entity\Postcode::class);

        $filter = $container->get('App\Filter\Postcode');

        return new LookupAction($repository, $filter);
    }
}
