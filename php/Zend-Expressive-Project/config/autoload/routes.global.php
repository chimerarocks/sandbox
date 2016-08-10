<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            TargetMkt\Application\Action\PingAction::class => TargetMkt\Application\Action\PingAction::class,
        ],
        'factories' => [
            TargetMkt\Application\Action\HomePageAction::class => TargetMkt\Application\Action\HomePageFactory::class,
            TargetMkt\Application\Action\UserPageAction::class => TargetMkt\Application\Action\UserPageFactory::class,
            TargetMkt\Application\Action\TestPageAction::class => TargetMkt\Application\Action\TestPageFactory::class,
            TargetMkt\Application\Action\Customer\CustomerListPageAction::class => TargetMkt\Application\Action\Customer\CustomerListPageFactory::class,
            TargetMkt\Application\Action\Customer\CustomerCreatePageAction::class => TargetMkt\Application\Action\Customer\CustomerCreatePageFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => TargetMkt\Application\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => TargetMkt\Application\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'user',
            'path' => '/user',
            'middleware' => TargetMkt\Application\Action\UserPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'test',
            'path' => '/test',
            'middleware' => TargetMkt\Application\Action\TestPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'customer.list',
            'path' => '/admin/customers',
            'middleware' => TargetMkt\Application\Action\Customer\CustomerListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'customer.create',
            'path' => '/admin/customer/create',
            'middleware' => TargetMkt\Application\Action\Customer\CustomerCreatePageAction::class,
            'allowed_methods' => ['GET','POST'],
        ],
    ],
];
