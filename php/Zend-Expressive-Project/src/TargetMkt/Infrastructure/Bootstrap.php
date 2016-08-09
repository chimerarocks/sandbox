<?php

namespace TargetMkt\Infrastructure;

use TargetMkt\Domain\Service\BootstrapInterface;

class Bootstrap implements BootstrapInterface {
	public function create() 
	{
		require_once __DIR__ . '/config/doctrine.php';
	}
}