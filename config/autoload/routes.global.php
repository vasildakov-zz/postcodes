<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
            App\Action\PingAction::class => App\Action\PingAction::class,
            App\Action\ErrorAction::class => App\Action\ErrorAction::class,
            App\Middleware\Postcode\ValidateAction::class => App\Middleware\Postcode\ValidateAction::class,
            Zend\EventManager\EventManager::class => Zend\EventManager\EventManager::class,

        ],
        'factories' => [
            App\Action\HomePageAction::class => App\Action\HomePageFactory::class,

            App\Middleware\Postcode\LookupAction::class => App\Middleware\Postcode\LookupFactory::class,
            App\Middleware\Postcode\AutocompleteAction::class => App\Middleware\Postcode\AutocompleteFactory::class,
            App\Middleware\Postcode\RandomAction::class  => App\Middleware\Postcode\RandomFactory::class,

            App\Middleware\Authentication\Authentication::class => App\Middleware\Authentication\AuthenticationFactory::class,

            Monolog\Logger::class => App\Middleware\Logger\MonologFactory::class,
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
                App\Middleware\Postcode\LookupAction::class
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.postcodes.validate',
            'path' => '/api/postcodes/{postcode}/validate',
            'middleware' => [
                App\Middleware\Postcode\ValidateAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.postcodes.autocomplete',
            'path' => '/api/postcodes/{postcode}/autocomplete',
            'middleware' => [
               App\Middleware\Postcode\AutocompleteAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.postcodes.random',
            'path' => '/api/random/postcodes',
            'middleware' => [
                App\Middleware\Postcode\RandomAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
    ],
];
