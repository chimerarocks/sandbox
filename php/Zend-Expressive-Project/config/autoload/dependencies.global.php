<?php
return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            \Zend\Expressive\Helper\ServerUrlHelper::class => 

                \Zend\Expressive\Helper\ServerUrlHelper::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Application::class => ApplicationFactory::class,
            \Symfony\Component\Console\Helper\UrlHelper::class => 
                \Zend\Expressive\Helper\UrlHelperFactory::class,

            \TargetMkt\Domain\Repository\CustomerRepositoryInterface::class => 
                \TargetMkt\Infrastructure\Persistence\Doctrine\Repository\CustomerRepositoryFactory::class,

            \Aura\Session\Session::class => 
                \DaMess\Factory\AuraSessionFactory::class,

            \TargetMkt\Domain\Service\FlashMessageInterface::class => 
                \TargetMkt\Infrastructure\Service\FlashMessageFactory::class,

            'doctrine:fixtures_cmd:load'   => 
                \CodeEdu\FixtureFactory::class,

            \TargetMkt\Infrastructure\Service\AuthService::class =>
                \TargetMkt\Infrastructure\Service\AuthServiceFactory::class
        ],
        'aliases' => [
            'Configuration' => 'config', //Doctrine needs a service called Configuration
            'Config' => 'config',
            \Zend\Authentication\AuthenticationService::class =>
                'doctrin.authenticationservice.orm_default'
        ],
    ],
];
