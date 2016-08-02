<?php

require __DIR__ . '/../vendor/autoload.php';

$uri = new \Zend\Diactoros\Uri('http://cep.republicavirtual.com.br/web_cep.php?cep=01021200');

$request = (new \Zend\Diactoros\Request())
	->withUri($uri)
	->withMethod('GET');

$guzzle = new \GuzzleHttp\Client();

$adapter = new \Http\Adapter\Guzzle6\Client($guzzle);


$response = $adapter->sendRequest($request);

printf("Status da resposta: %d - %s", $response->getStatusCode(), $response->getReasonPhrase());
printf("\nCabeçalhos:\n");

foreach ($response->getHeaders() as $header => $values) {
	printf("\t %s: %s\n", $header, implode(', ', $values));
}

printf("Mensagem: \n\n%s", $response->getBody());

printf("\n");