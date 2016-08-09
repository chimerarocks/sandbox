<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            TargetMkt\Action\PingAction::class => TargetMkt\Action\PingAction::class,
        ],
        'factories' => [
            TargetMkt\Action\HomePageAction::class => TargetMkt\Action\HomePageFactory::class,
            TargetMkt\Action\UserPageAction::class => TargetMkt\Action\UserPageFactory::class,
            TargetMkt\Action\TestPageAction::class => TargetMkt\Action\TestPageFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => TargetMkt\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => TargetMkt\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'user',
            'path' => '/user',
            'middleware' => TargetMkt\Action\UserPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'test',
            'path' => '/test',
            'middleware' => TargetMkt\Action\TestPageAction::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
