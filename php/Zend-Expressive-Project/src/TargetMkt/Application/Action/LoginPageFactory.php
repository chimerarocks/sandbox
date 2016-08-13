<?php

namespace TargetMkt\Application\Action;

use Interop\Container\ContainerInterface;
use TargetMkt\Application\Form\LoginForm;
use TargetMkt\Infrastructure\Service\AuthService;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class LoginPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $router   = $container->get(RouterInterface::class);
        $template = $container->get(TemplateRendererInterface::class);
        $form 	  = $container->get(LoginForm::class);
        $auth     = $container->get(AuthService::class)

        return new LoginPageAction($router, $template, $form, $auth);
    }
}
