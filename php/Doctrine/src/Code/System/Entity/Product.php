<?php

namespace Code\System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $name;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $description;

	/**
	 * @ORM\Column(type="float", length=10)
	 */
	private $value;

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