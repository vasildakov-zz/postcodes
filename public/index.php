<?php
//use Zend\Diactoros\Response\JsonResponse;

//echo phpinfo(); exit();


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
$app = $container->get(\Zend\Expressive\Application::class);

/* $app->get('/api/postcodes/:postcode', function ($request, $response, $next) {

    return new JsonResponse([
        'status' => 200,
        'data' => [
            'postcode'  => 'TW8 8FB',
            'outcode'   => 'TW8',
            'incode'    => '8FB',
            'latitude'  => 51.483954952877600,
            'longitude' => -0.312577856018865,
        ]
    ], 200, [
        "Access-Control-Allow-Origin" => "*",
        "Access-Control-Allow-Methods" => "GET, POST, PUT, DELETE"

    ]);

}); */

$app->run();
