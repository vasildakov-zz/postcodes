<?php
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;

return [
    'dependencies' => [
        'factories' => [
            Helper\ServerUrlMiddleware::class => Helper\ServerUrlMiddlewareFactory::class,
            Helper\UrlHelperMiddleware::class => Helper\UrlHelperMiddlewareFactory::class,

            App\Middleware\Logger\DebugLogger::class => App\Middleware\Logger\DebugLoggerFactory::class,
        ],
    ],
    // This can be used to seed pre- and/or post-routing middleware
    'middleware_pipeline' => [
        'before' => [
            'middleware' => [
                //
            ],
            'priority' => 1,
        ],
        'always' => [
            'middleware' => [
                // Add more middleware here that you want to execute on
                // every request:
                // - bootstrapping
                // - pre-conditions
                // - modifications to outgoing responses
                Helper\ServerUrlMiddleware::class,
            ],
            'priority' => 10000,
        ],
        'routing' => [
            'middleware' => [
                ApplicationFactory::ROUTING_MIDDLEWARE,
                Helper\UrlHelperMiddleware::class,

                //App\Middleware\Logger\DebugLogger::class,
                // Add more middleware here that needs to introspect the routing
                // results; this might include:
                // - route-based authentication
                // - route-based validation
                // - etc.
                ApplicationFactory::DISPATCH_MIDDLEWARE,
            ],
            'priority' => 1,
        ],
        'api' => [
            'path' => '/api',
            'middleware' => [
                App\Middleware\Authentication\Authentication::class,
            ],
            'priority' => 100,
        ],
        'error' => [
            'middleware' => [
                // Add error middleware here.
                // App\Middleware\Logger\DebugLogger::class,
            ],
            'error'    => true,
            'priority' => -10000,
        ],
    ],
];
