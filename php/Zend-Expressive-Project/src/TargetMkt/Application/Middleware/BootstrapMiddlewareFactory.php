<?php

namespace TargetMkt\Application\Middleware;

use Interop\Container\ContainerInterface;
use TargetMkt\Infrastructure\Bootstrap;
use TargetMkt\Domain\Service\FlashMessageInterface;

class BootstrapMiddlewareFactory 
{
	public function __invoke(ContainerInterface $container)
	{
		$bootstrap = new Bootstrap();
		$flash = $container->get(FlashMessageInterface::class);
		return new BootstrapMiddleware($bootstrap, $flash);
	}
}