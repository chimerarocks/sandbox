<?php

namespace Code\System\Mapper;

use Code\System\Entity\Product;
use Doctrine\ORM\EntityManager;

class ProductMapper
{

	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	public function insert(Product $product)
	{
		$this->em->persist($product);
		$this->em->flush();
		return [
			'name' => $product->getName(),
			'description' => $product->getDescription(),
			'value' => $product->getValue()
		];
	}

	public function fetchAll()
	{
		return $this->em->getRepository(Product::class)->findAll();
	}

	public function find($id)
	{
		return $this->em->find(Product::class, $id);
	}

	public function update($id, Product $product)
	{
		$productBase = $this->em->find(Product::class, $id);
		$this->em->persist($productBase);

		$productBase->setName($product->getName());
		$productBase->setDescription($product->getDescription());
		$productBase->setValue($product->getValue());

		$this->em->flush();

		return [
			'name' => $product->getName(),
			'description' => $product->getDescription(),
			'value' => $product->getValue()
		];
	}

	public function remove($id)
	{
		$this->em->remove($this->em->find(Product::class, $id));
		$this->em->flush();
		return [
			'success' => true
		];
	}
}