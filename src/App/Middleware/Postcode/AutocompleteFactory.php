<?php

namespace App\Middleware\Postcode;

use App\Entity;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\EventManager\EventManager;
use Doctrine\ORM\EntityManager;

class AutocompleteFactory
{
    /**
     * @param  ContainerInterface $container
     * @return AutocompleteAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $em = $container->get(EntityManager::class);
        $repository = $em->getRepository(Entity\Postcode::class);

        return new AutocompleteAction($repository);
    }
}
