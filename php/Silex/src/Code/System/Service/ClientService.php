<?php

namespace Code\System\Service;

use Code\System\Entity\Client;
use Code\System\Mapper\ClientMapper;

class ClientService
{
	private $client;
	private $mapper;

	public function __construct(Client $client, ClientMapper $mapper)
	{
		$this->client = $client;
		$this->mapper = $mapper;
	}

	public function insert(array $data)
	{
		$this->client->setName($data['name']);
		$this->client->setEmail($data['email']);
		$this->client->setCpf($data['cpf']);

		return $this->mapper->insert($this->client);
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
		$this->client->setName($data['name']);
		$this->client->setEmail($data['email']);
		$this->client->setCpf($data['cpf']);

		return $this->mapper->update($id, $this->client);
	}
}