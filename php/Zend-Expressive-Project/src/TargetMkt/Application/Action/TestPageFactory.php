<?php

namespace TargetMkt\Application\Action;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use TargetMkt\Domain\Repository\CustomerRepositoryInterface;

class TestPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = ($container->has(TemplateRendererInterface::class))
            ? $container->get(TemplateRendererInterface::class)
            : null;

        return new TestPageAction($container->get(CustomerRepositoryInterface::class), $template);
    }
}
