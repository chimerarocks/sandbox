<?php

namespace Code\System\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table="clients_profile"
 */
class ClientProfile 
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=20)
	 */
	private $cpf;

	/**
	 * @ORM\Column(type="string", length=20)
	 */
	private $rg;

	public function getId()
	{
		return $this->id;
	}

	public function setCpf($cpf) 
	{
		$this->cpf = $cpf;
	}

	public function getCpf()
	{
		return $this->cpf;
	}

	public function setRg($rg) 
	{
		$this->rg = $rg;
	}

	public function getRg()
	{
		return $this->rg;
	}
}