<?php

require_once __DIR__ . '/../bootstrap.php';

use Symfony\Component\HttpFoundation\Response;

$response = new Response();

$app->get('/', function() use ($response) {
	$response->setContent('Olá Mundo!');
	return $response;
});

$app->get('/ola/{name}', function($name) use ($response) {
	$response->setContent("Olá {$name} !");
	return $response;
});

$app->get('/clientes', function() use ($response) {
	$clientes = [
		'nome' => 'Joao Pedro',
		'email' => 'joaopedrodslv@gmail.com',
		'cpf' => '654889713'
	];

	$response->setContent(json_encode($clientes));
	$response->headers->set('Content-Type', 'application/json');
	return $response;
});

$app->run();