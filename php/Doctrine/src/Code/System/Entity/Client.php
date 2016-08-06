<?php

namespace Code\System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="clients")
 */
class Client
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
	private $email;

	/**
	 * @ORM\Column(type="string", length=20)
	 */
	private $cpf;

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

	public function setEmail($email) 
	{
		$this->email = $email;
	}

	public function getEmail() 
	{
		return $this->email;
	}

	public function setCpf($cpf) 
	{
		$this->cpf = $cpf;
	}

	public function getCpf()
	{
		return $this->cpf;
	}
}