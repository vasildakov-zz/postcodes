<?php
return [
    'dependencies' => [
        'invokables' => [
        ],

        'factories' => [
            App\Command\GreetCommand::class => App\Command\GreetCommandFactory::class,
        ],
    ],

    'console' => [
        'commands' => [
            App\Command\GreetCommand::class,
        ],
    ],
];