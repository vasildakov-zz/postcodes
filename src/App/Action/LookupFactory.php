<?php

namespace App\Action;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use App\Repository\PostcodeRepositoryInterface;

class LookupFactory
{
    public function __invoke(ContainerInterface $container)
    {
        if (!$container->has(PostcodeRepositoryInterface::class)) {
            throw new \Exception("Error Processing Request");
        }

        $repository = $container->get(PostcodeRepositoryInterface::class);

        return new Lookup($repository);
    }
}
