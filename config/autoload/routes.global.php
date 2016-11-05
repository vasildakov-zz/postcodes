<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\ZendRouter::class,
            Application\Action\PingAction::class => Application\Action\PingAction::class,

        ],
        'factories' => [
            Application\Action\HomePageAction::class => Application\Action\HomePageFactory::class,

            Application\Action\Lookup::class => Application\Action\LookupFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => Application\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => Application\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.postcode.lookup',
            'path' => '/api/postcodes/:postcode',
            'middleware' => Application\Action\Lookup::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
