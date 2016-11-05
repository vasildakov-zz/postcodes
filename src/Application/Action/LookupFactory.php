<?php

namespace Application\Action;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

use Infrastructure\Repository\Zend\PostcodeRepository;

class LookupFactory
{
    public function __invoke(ContainerInterface $container)
    {
        if (!$container->has(PostcodeRepository::class)) {
            throw new \Exception("Error Processing Request");
        }

        $repository = $container->get(PostcodeRepository::class);

        return new Lookup($repository);
    }
}
