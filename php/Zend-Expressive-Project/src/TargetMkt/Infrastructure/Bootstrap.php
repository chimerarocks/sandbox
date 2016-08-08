<?php

namespace TargetMkt\Infrastructure;

use TargetMkt\Service\BootstrapInterface;

class Bootstrap implements BootstrapInterface {
	public function create() 
	{
		require_once __DIR__ . '/config/doctrine.php';
	}
}