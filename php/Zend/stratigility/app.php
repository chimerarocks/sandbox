<?php

/**
	index.php com classes
*/


require __DIR__ . '/vendor/autoload.php';

use App\AppMiddleWare;

$server = \Zend\Diactoros\Server::createServer(
	new AppMiddleWare(),
	$_SERVER, 
	$_GET, 
	$_POST, 
	$_COOKIE, 
	$_FILES
);

$server->listen();