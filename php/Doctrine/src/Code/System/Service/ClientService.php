<?php

namespace Code\System\Service;

use Code\System\Entity\Client;
use Doctrine\ORM\EntityManager;

class ClientService
{
	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	public function insert(array $data)
	{
		$client = new Client();
		$client->setName($data['name']);
		$client->setEmail($data['email']);
		$client->setCpf($data['cpf']);

		$this->em->persist($client);
		$this->em->flush();

		return $client;
	}

	public function fetchAll()
	{
		return $this->em->getRepository(Client::class)->findAll();
	}

	public function find($id)
	{
		return $this->em->find(Client::class, $id);
	}

	public function update($id, array $data)
	{
		$client = $this->em->getReference(Client::class, $id);
		$client->setName($data['name']);
		$client->setEmail($data['email']);
		$client->setCpf($data['cpf']);

		$this->em->persist($client);
		$this->em->flush();

		return $client;
	}

	public function remove($id)
	{
		$client = $this->em->getReference(Client::class, $id);
		$this->em->remove($client);
		$this->em->flush();
		return [
			'success' => true
		];
	}
}