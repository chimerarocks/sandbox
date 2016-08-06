<?php

namespace Code\System\Service;

use Code\System\Entity\Product;
use Doctrine\ORM\EntityManager;

class ProductService
{
	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	public function insert(array $data)
	{
		$product = new Product();
		$product->setName($data['name']);
		$product->setDescription($data['description']);
		$product->setValue($data['value']);

		$this->em->persist($product);
		$this->em->flush();

		return $product;
	}

	public function fetchAll()
	{
		return $this->em->getRepository(Product::class)->findAll();
	}

	public function find($id)
	{
		return $this->em->find(Product::class, $id);
	}

	public function update($id, array $data)
	{
		$product = $this->em->getReference(Product::class, $id);
		$product->setName($data['name']);
		$product->setDescription($data['description']);
		$product->setValue($data['value']);

		$this->em->persist($product);
		$this->em->flush();

		return $product;
	}

	public function remove($id)
	{
		$product = $this->em->getReference(Product::class, $id);
		$this->em->remove($product);
		$this->em->flush();
		return [
			'success' => true
		];
	}
}