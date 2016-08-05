<?php

namespace Code\System\Mapper;

use Code\System\Entity\Client;

class ClientMapper
{
	private $dataset = [
		1 => [
				'id' => 1,
				'name' => 'Client A',
				'email' => 'clienta@client.com',
				'cpf' => '6584621'
			],
		2 => [
				'id' => 2,
				'name' => 'Client B',
				'email' => 'clientb@client.com',
				'cpf' => '6584622'
			],
		3 => [
				'id' => 3,
				'name' => 'Client C',
				'email' => 'clientc@client.com',
				'cpf' => '6584623'
			]
	];

	public function insert(Client $client)
	{
		return [
			'name' => $client->getName(),
			'email' => $client->getEmail(),
			'cpf' => $client->getCpf()
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

	public function update($id, Client $client)
	{
		return [
			'name' => $client->getName(),
			'email' => $client->getEmail(),
			'cpf' => $client->getCpf()
		];
	}
}