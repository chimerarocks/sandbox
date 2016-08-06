<?php

namespace Code\System\Mapper;

use Code\System\Entity\Client;
use Doctrine\ORM\EntityManager;

class ClientMapper
{

	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	public function insert(Client $client)
	{
		$this->em->persist($client);
		$this->em->flush();

		return [
			'success' => true, 
			'id' => $client->getId(),
			'name' => $client->getName(),
			'email' => $client->getEmail(),
			'cpf' => $client->getCpf()
		];
	}

	public function fetchAll()
	{
		return $this->em->getRepository(Client::class)->findAll();
	}

	public function find($id)
	{
		return $this->em->find(Client::class, $id);
	}

	public function update($id, Client $client)
	{
		$clientBase = $this->em->find(Client::class, $id);
		$this->em->persist($clientBase);

		$clientBase->setName($client->getName());
		$clientBase->setEmail($client->getEmail());
		$clientBase->setCpf($client->getCpf());

		$this->em->flush();

		return [
			'success' => true, 
			'id' => $client->getId(),
			'name' => $client->getName(),
			'email' => $client->getEmail(),
			'cpf' => $client->getCpf()
		];
	}

	public function remove($id)
	{
		$this->em->remove($this->em->find(Client::class, $id));
		$this->em->flush();
		return [
			'success' => true
		];
	}
}