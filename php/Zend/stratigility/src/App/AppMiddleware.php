<?php

namespace App;

use Zend\Stratigility\MiddlewarePipe;
use App\Rota1Middleware;
use App\Rota2Middleware;
use App\Rota3Middleware;
use App\Admin\AdminMiddleware;

class AppMiddleware extends MiddlewarePipe {

	public function __construct()
	{
		parent::__construct();
		$this->pipe('/', function($request, $response, $next) {
			if (!in_array($request->getUri()->getPath(), ['/', ''], true)) {
				return $next($request, $response);
			}
			return $response->write('Rota principal');
		});
		$this->pipe('/rota1', new Rota1Middleware());
		$this->pipe('/rota2', new Rota2Middleware());
		$this->pipe('/rota3', new Rota3Middleware());
		$this->pipe('/admin', new AdminMiddleware());
	}

}