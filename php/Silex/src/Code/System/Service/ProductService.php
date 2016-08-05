<?php

namespace Code\System\Service;

use Code\System\Entity\Product;
use Code\System\Mapper\ProductMapper;

class ProductService
{
	private $product;
	private $mapper;

	public function __construct(Product $product, ProductMapper $mapper)
	{
		$this->product = $product;
		$this->mapper = $mapper;
	}

	public function insert(array $data)
	{
		$this->product->setName($data['name']);
		$this->product->setDescription($data['description']);
		$this->product->setValue($data['value']);

		return $this->mapper->insert($this->product);
	}

	public function fetchAll()
	{
		return $this->mapper->fetchAll();
	}

	public function find($id)
	{
		return $this->mapper->find($id);
	}

	public function update($id, array $data)
	{
		$this->product->setName($data['name']);
		$this->product->setDescription($data['description']);
		$this->product->setValue($data['value']);

		return $this->mapper->update($id, $this->product);
	}
}