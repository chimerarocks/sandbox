<?php

require __DIR__ . '/vendor/autoload.php';

$app = new \Zend\Stratigility\MiddlewarePipe();
$admin = new \Zend\Stratigility\MiddlewarePipe();

$server = \Zend\Diactoros\Server::createServer($app, $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);

$admin->pipe('/', function($request, $response, $next) {
	if (!in_array($request->getUri()->getPath(), ['/', ''], true)) {
		return $next($request, $response);
	}
	return $response->write('Admin Rota principal');
});

//Só executa a rota 1 e encerra a aplicação
$admin->pipe('/rota1', function($request, $response, $next) {
	return $response->write('Admin Rota 1');
});

//Executa a rota1, verifica que não se enquadra, e executa a rota 2
$admin->pipe('/rota2', function($request, $response, $next) {
	return $response->write('Admin Rota 2');
});

//Executa a rota 1, a 2 e a 3
$admin->pipe('/rota3', function($request, $response, $next) {
	return $response->write('Admin Rota 3');
});

//Next permite que mesmo que se enquadre a rota ele passa para a próxima rota
$app->pipe('/', function($request, $response, $next) {
	if (!in_array($request->getUri()->getPath(), ['/', ''], true)) {
		return $next($request, $response);
	}
	return $response->write('Rota principal');
});

//Só executa a rota 1 e encerra a aplicação
$app->pipe('/rota1', function($request, $response, $next) {
	return $response->write('Rota 1');
});

//Executa a rota1, verifica que não se enquadra, e executa a rota 2
$app->pipe('/rota2', function($request, $response, $next) {
	return $response->write('Rota 2');
});

//Executa a rota 1, a 2 e a 3
$app->pipe('/rota3', function($request, $response, $next) {
	return $response->write('Rota 3');
});

//Subcontainers middlewares. Percorrerá todos os middlewares de app e só depois tenta o admin
$app->pipe('/admin', $admin);

$server->listen();