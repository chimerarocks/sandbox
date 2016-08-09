<?php

namespace TargetMkt\Application\Middleware;

use Interop\Container\ContainerInterface;
use TargetMkt\Infrastructure\Bootstrap;

class BootstrapMiddlewareFactory 
{
	public function __invoke(ContainerInterface $container)
	{
		$bootstrap = new Bootstrap();
		return new BootstrapMiddleware($bootstrap);
	}
}