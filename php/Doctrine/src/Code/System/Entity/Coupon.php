<?php

namespace Code\System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="coupons")
 */
class Coupon
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
	private $code;

	/**
	 * @ORM\Column(type="float", length=10)
	 */
	private $value;

	public function getId() 
	{
		return $this->id;
	}

	public function setCode($code) 
	{
		$this->code = $code;
	}

	public function getCode() 
	{
		return $this->code;
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