<?php

namespace App\Action;

use App\Entity;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;

class PostcodeFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $em = $container->get('Doctrine\ORM\EntityManager');
        $repository = $em->getRepository(Entity\Postcode::class);

        $filter = $container->get('App\Filter\Postcode');

        return new PostcodeAction($repository, $filter);
    }
}
