<?php

namespace ChimeraRocks\Database;

use ChimeraRocks\Database\Contracts\RepositoryInterface;

class AbstractRepository implements RepositoryInterface
{

	public function all(array $columns = ['*'])
	{
		throw new \Exception('Method not implemented');
	}

	public function create(array $data)
	{
		throw new \Exception('Method not implemented');
	}

	public function update(array $data, $id)
	{
		throw new \Exception('Method not implemented');
	}

	public function delete($id)
	{
		throw new \Exception('Method not implemented');
	}

	public function find($id, array $columns = ['*'])
	{
		throw new \Exception('Method not implemented');
	}

	public function findBy($field, $value, $columns = ['*'])
	{
		throw new \Exception('Method not implemented');
	}
}