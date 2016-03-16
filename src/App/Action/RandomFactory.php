<?php

namespace App\Action;

use App\Entity;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;

class RandomFactory
{
    /**
     * @param  ContainerInterface $container
     * @return AutocompleteAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $em = $container->get('Doctrine\ORM\EntityManager');
        $repository = $em->getRepository(Entity\Postcode::class);

        return new RandomAction($repository);
    }
}
