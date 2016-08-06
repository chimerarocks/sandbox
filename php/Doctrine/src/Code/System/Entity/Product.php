<?php

namespace Code\System\Entity;

class Product
{
	private $id;
	private $name;
	private $description;
	private $value;

	public function setId($id) 
	{
		$this->id = $id;
	}

	public function getId() 
	{
		return $this->id;
	}

	public function setName($name) 
	{
		$this->name = $name;
	}

	public function getName() 
	{
		return $this->name;
	}

	public function setDescription($description) 
	{
		$this->description = $description;
	}

	public function getDescription() 
	{
		return $this->description;
	}

	public function setValue($value) 
	{
		$this->value = $value;
	}

	public function getValue()
	{
		return $this->value;
	}
}