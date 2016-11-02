<?php // src/App/Command/GreetCommandFactory.php

namespace App\Command;

use Interop\Container\ContainerInterface;
use Monolog\Logger;

class GreetCommandFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $logger = $container->get(Logger::class);

        return new GreetCommand($logger);
    }
}