<?php

namespace TargetMkt\Infrastructure\Service;

use Interop\Container\ContainerInterface;

class CustomerRepositoryFactory
{
	public function __invoke(ContainerInterface $container)
	{
		$session = $container->get(\Aura\Session\Session::class);
		return new FlashMessage($session);
	}
}