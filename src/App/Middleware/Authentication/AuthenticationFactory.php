<?php

namespace App\Middleware\Authentication;

use App\Entity;
use Interop\Container\ContainerInterface;
use App\Middleware\Authentication\Authentication;
use Doctrine\ORM\EntityManager;

class AuthenticationFactory
{
    /**
     * @param  ContainerInterface $container
     * @return Authentication
     */
    public function __invoke(ContainerInterface $container)
    {
        $em = $container->get(EntityManager::class);
        $repository = $em->getRepository(Entity\ApiKey::class);

        return new Authentication($repository);
    }
}
