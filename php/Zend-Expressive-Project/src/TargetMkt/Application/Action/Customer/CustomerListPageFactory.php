<?php

namespace TargetMkt\Application\Action\Customer;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use TargetMkt\Domain\Repository\CustomerRepositoryInterface;

class CustomerListPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CustomerRepositoryInterface::class);
        return new CustomerListPageAction($repository, $template);
    }
}
