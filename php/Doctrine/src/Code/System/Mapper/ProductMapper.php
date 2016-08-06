<?php

namespace Code\System\Mapper;

use Code\System\Entity\Product;

class ProductMapper
{
	private $dataset = [
		1 => [
				'id' => 1,
				'name' => 'Product A',
				'description' => 'Um bom produto',
				'value' => 12
			],
		2 => [
				'id' => 2,
				'name' => 'Product B',
				'description' => 'Um bom produto',
				'value' => 15.2
			],
		3 => [
				'id' => 3,
				'name' => 'Product C',
				'description' => 'Um bom produto',
				'value' => 23.1
			]
	];

	public function insert(Product $product)
	{
		return [
			'name' => $product->getName(),
			'description' => $product->getDescription(),
			'value' => $product->getValue()
		];
	}

	public function fetchAll()
	{
		return $this->dataset;
	}

	public function find($id)
	{
		return $this->dataset[$id];
	}

	public function update($id, Product $product)
	{
		return [
			'name' => $product->getName(),
			'description' => $product->getDescription(),
			'value' => $product->getValue()
		];
	}
}