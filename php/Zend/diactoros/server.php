<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

require __DIR__ . '/../vendor/autoload.php';

$server = \Zend\Diactoros\Server::createServer(
	function(ServerRequestInterface $request, ResponseInterface $response, $finalHandler) {
		$data = $request->getParsedBody();
		if($data['email'] == 'teste@teste.com') {
			$response->getBody()->write('O e-mail enviado é ' . $data['email']);
		} else {
			// Este return irá sobrescrever o response
			return $finalHandler($request, $response);
		}

	},
	$_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);

$server->listen(
	function(ServerRequestInterface $request, ResponseInterface $response, $error = null) {
		return new \Zend\Diactoros\Response\HtmlResponse("O parâmetro e-mail está inválido!", 400);
	});