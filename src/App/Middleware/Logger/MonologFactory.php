<?php
namespace App\Middleware\Logger;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

class MonologFactory
{
    /**
     * @param  ContainerInterface $container
     * @return DebugLogger
     */
    public function __invoke(ContainerInterface $container)
    {
        // get monolog config
        $config = $container->get('config');

        if (!isset($config['monolog'])) {
            throw new ServiceNotCreatedException('monolog configuration error');
        }

        // create new channel
        $logger = new Logger('name');
        $logger->pushHandler(new StreamHandler($config['monolog']['debug'], Logger::DEBUG));

        return $logger;
    }
}
