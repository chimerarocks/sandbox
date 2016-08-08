<?php

require_once __DIR__ . '/../bootstrap.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Code\System\Service\ClientService;
use Code\System\Service\ProductService;
use Code\System\Service\InterestService;

$serializer = new Serializer(
    [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
    [new JsonEncoder()]
);

$app['serializer'] = $serializer;

$app['clientService'] = function() use ($em) {
	$clientService = new ClientService($em);
	return $clientService;
};

$app['interestService'] = function() use ($em) {
	$interestService = new InterestService($em);
	return $interestService;
};

$app['productService'] = function() use ($em) {
	$productService = new ProductService($em);
	return $productService;
};

$app->get('/', function() use ($app) {
	return $app['twig']->render('index.twig', []);
})->bind('index');


/**
 * Interests
 */
$app->get('/api/interests', function() use ($app) {
	$dataset = $app['interestService']->fetchAll();
	return $app['serializer']->serialize($dataset, 'json');
});

$app->post('/api/interests', function (Request $req) use ($app) {
	$data['name'] = $req->get('name');
	$dataset = $app['interestService']->insert($data);
	return $app['serializer']->serialize($dataset, 'json');
});

/**
 * Clients
 */
$app->get('/clients', function() use ($app) {
	$clients = $app['clientService']->fetchAll();
	return $app['twig']->render('clients.twig', ['clients' => $clients]);
})->bind('clients');

$app->get('/api/clients', function() use ($app) {
	$dataset = $app['clientService']->fetchAll();
	return $app['serializer']->serialize($dataset, 'json');
});

$app->get('/api/clients/{id}', function($id) use ($app) {
	$dataset = $app['clientService']->find($id);
	return $app['serializer']->serialize($dataset, 'json');
});

$app->delete('/api/clients/{id}', function($id) use ($app) {
	$dataset = $app['clientService']->remove($id);
	return $app->json($dataset);
});

$app->post('/api/clients', function(Request $req) use ($app) {
	$constraint = new Assert\Collection([
	    'name' => new Assert\Length(['min' => 3]),
	    'email' => new Assert\Email(),
	    'cpf' => new Assert\Required(),
	    'rg' => new Assert\Required(),
	    'interest' => new Assert\Required()
	]);

	$data['name'] = $req->get('name');
	$data['email'] = $req->get('email');
	$data['cpf'] = $req->get('cpf');
	$data['rg'] = $req->get('rg');
	$data['interest'] = $req->get('interest');

	$errors = $app['validator']->validate($data, $constraint);

	if (count($errors) > 0) {
        return $app->json((string) $errors);
	}

	$dataset = $app['clientService']->insert($data);
	return $app->json($dataset);
});

$app->put('/api/clients/{id}', function($id, Request $req) use ($app) {
	$constraint = new Assert\Collection([
	    'name' => new Assert\Length(['min' => 3]),
	    'email' => new Assert\Email(),
	    'cpf' => new Assert\Required(),
	    'rg' => new Assert\Required(),
	]);

	$data['name'] = $req->get('name');
	$data['email'] = $req->get('email');
	$data['cpf'] = $req->get('cpf');
	$data['rg'] = $req->get('rg');

	$errors = $app['validator']->validate($data, $constraint);

	if (count($errors) > 0) {
        return $app->json((string) $errors);
	}

	$dataset = $app['clientService']->update($id, $data);
	return $app->json($dataset);
});

/**
 * Products
 */
$app->get('/products', function() use ($app) {
	$products = $app['productService']->fetchAll();
	return $app['twig']->render('products.twig', ['products' => $products]);
})->bind('products');

$app->get('/api/products', function() use ($app) {
	$dataset = $app['productService']->fetchAll();
	return $app['serializer']->serialize($dataset, 'json');
});

$app->get('/api/products/{id}', function($id) use ($app) {
	$dataset = $app['productService']->find($id);
	return $app['serializer']->serialize($dataset, 'json');
});

$app->post('/api/products', function(Request $req) use ($app) {
	$data['name'] = $req->get('name');
	$data['description'] = $req->get('description');
	$data['value'] = $req->get('value');

	$dataset = $app['productService']->insert($data);
	return $app->json($dataset);
});

$app->put('/api/products/{id}', function($id, Request $req) use ($app) {
	$data['name'] = $req->get('name');
	$data['description'] = $req->get('description');
	$data['value'] = $req->get('value');

	$dataset = $app['productService']->update($id, $data);
	return $app->json($dataset);
});

$app->delete('/api/products/{id}', function($id) use ($app) {
	$dataset = $app['productService']->remove($id);
	return $app->json($dataset);
});

$app->run();