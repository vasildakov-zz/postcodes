<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\ZendRouter::class,
            App\Action\PingAction::class => App\Action\PingAction::class,

        ],
        'factories' => [
            App\Action\HomePageAction::class => App\Action\HomePageFactory::class,

            App\Action\Lookup::class => App\Action\LookupFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => App\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => App\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.postcode.lookup',
            'path' => '/api/postcodes/:postcode',
            'middleware' => App\Action\Lookup::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
