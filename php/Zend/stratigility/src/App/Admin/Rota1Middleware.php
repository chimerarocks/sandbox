<?php

namespace App\Admin;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Stratigility\MiddlewareInterface;

class Rota1Middleware implements MiddlewareInterface {

	public function __invoke(Request $request, Response $response, callable $out = null)
	{
		return $response->write('admin rota1');
	}
	
}