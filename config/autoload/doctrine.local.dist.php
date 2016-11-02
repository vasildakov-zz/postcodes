<?php // config/autoload/doctrine.local.php

return [
    'doctrine' => [
        'orm'        => [
            'auto_generate_proxy_classes' => false,
            'proxy_dir'                   => 'data/cache/EntityProxy',
            'proxy_namespace'             => 'EntityProxy',
            'underscore_naming_strategy'  => true,
        ],
        'connection' => [
            // default connection
            'orm_default' => [
                'driver'   => 'pdo_mysql',
                'host'     => '127.0.0.1',
                'port'     => '3306',
                'dbname'   => 'dbname',
                'user'     => 'user',
                'password' => 'password',
                'charset'  => 'UTF8',
            ],
        ],
        'cache'      => [
            'redis' => [
                'host' => '127.0.0.1',
                'port' => '6379',
            ],
        ],
    ],
];