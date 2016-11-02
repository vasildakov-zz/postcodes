<?php

// Delegate static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server'
    && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
) {
    return false;
}

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/** @var \Interop\Container\ContainerInterface $container */
$container = require 'config/container.php';

/** @var \Zend\Expressive\Application $app */
$app = $container->get(Zend\Expressive\Application::class);

/** @var \Zend\EventManager\EventManager $evm */
$evm = $container->get(Zend\EventManager\EventManager::class);

// attach listeners to the event manager
/*$evm->attach(\App\Listener\Aggregate::class, function($e) {
    var_dump($e);
});*/

/* $evm->attach('do', function ($app) {
    var_dump($app); exit('here');
});

$evm->trigger('do', null, $app); */

$app->run();
