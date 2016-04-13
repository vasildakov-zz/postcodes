<?php

namespace App\Middleware\Authentication;

use App\Entity;
use Interop\Container\ContainerInterface;
use App\Middleware\Authentication\Authentication;

class AuthenticationFactory
{
    /**
     * @param  ContainerInterface $container
     * @return Authentication
     */
    public function __invoke(ContainerInterface $container)
    {
        $em = $container->get('Doctrine\ORM\EntityManager');
        $repository = $em->getRepository(Entity\ApiKey::class);

        return new Authentication($repository);
    }
}
