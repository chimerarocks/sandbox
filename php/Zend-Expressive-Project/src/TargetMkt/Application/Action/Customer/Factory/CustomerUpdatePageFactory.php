<?php

namespace TargetMkt\Application\Action\Customer\Factory;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use TargetMkt\Domain\Repository\CustomerRepositoryInterface;
use TargetMkt\Application\Action\Customer\CustomerUpdatePageAction;
use TargetMkt\Application\Form\CustomerForm;

class CustomerUpdatePageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CustomerRepositoryInterface::class);
        $router = $container->get(RouterInterface::class);
        $form = $container->get(CustomerForm::class);
        return new CustomerUpdatePageAction($repository, $template, $router, $form);
    }
}
