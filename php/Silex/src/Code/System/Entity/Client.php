<?php

namespace Code\System\Entity;

class Client
{
	private $name;
	private $email;
	private $cpf;

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