<?php

namespace TargetMkt\Action;

use Interop\Container\ContainerInterface;
use TargetMkt\Action\BootstrapAction;
use TargetMkt\Infrastructure\Bootstrap;

class BootstrapActionFactory 
{
	public function __invoke(ContainerInterface $container)
	{
		$bootstrap = new Bootstrap();
		return new BootstrapAction($bootstrap);
	}
}