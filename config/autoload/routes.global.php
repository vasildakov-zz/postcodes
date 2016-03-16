<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
            App\Action\PingAction::class => App\Action\PingAction::class,
            App\Action\ErrorAction::class => App\Action\ErrorAction::class,
            App\Action\ValidateAction::class => App\Action\ValidateAction::class,
        ],
        'factories' => [
            App\Action\HomePageAction::class     => App\Action\HomePageFactory::class,
            App\Action\LookupAction::class       => App\Action\LookupFactory::class,
            App\Action\AutocompleteAction::class => App\Action\AutocompleteFactory::class,
            App\Action\RandomAction::class       => App\Action\RandomFactory::class,
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
            'name' => 'api.postcodes.lookup',
            'path' => '/api/postcodes/{postcode}',
            'middleware' => [
                App\Action\LookupAction::class
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.postcodes.validate',
            'path' => '/api/postcodes/{postcode}/validate',
            'middleware' => [
                App\Action\ValidateAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.postcodes.autocomplete',
            'path' => '/api/postcodes/{postcode}/autocomplete',
            'middleware' => [
                App\Action\AutocompleteAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.postcodes.random',
            'path' => '/api/random/postcodes',
            'middleware' => [
                App\Action\RandomAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
    ],
];
