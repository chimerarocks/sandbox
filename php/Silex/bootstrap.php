<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = new \Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), 
	[
		'twig.path' => __DIR__ . '/views'
	]
);

$app->register(new Silex\Provider\ValidatorServiceProvider());