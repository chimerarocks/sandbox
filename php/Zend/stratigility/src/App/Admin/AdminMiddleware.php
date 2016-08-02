<?php

namespace App\Admin;

use Zend\Stratigility\MiddlewarePipe;
use App\Admin\Rota1Middleware;
use App\Admin\Rota2Middleware;
use App\Admin\Rota3Middleware;
use App\Admin\AdminMiddleware;

class AdminMiddleware extends MiddlewarePipe {

	public function __construct()
	{
		parent::__construct();
		$this->pipe('/', function($request, $response, $next) {
			if (!in_array($request->getUri()->getPath(), ['/', ''], true)) {
				return $next($request, $response);
			}
			return $response->write('Rota Admin principal');
		});
		$this->pipe('/rota1', new Rota1Middleware());
		$this->pipe('/rota2', new Rota2Middleware());
		$this->pipe('/rota3', new Rota3Middleware());
	}

}