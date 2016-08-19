<?php

namespace Test\Stubs\Criterias;

use ChimeraRocks\Database\Contracts\CriteriaInterface;
use ChimeraRocks\Database\Contracts\RepositoryInterface;

class FindByName implements CriteriaInterface
{
	private $name;

	public function __construct($name)
	{

		$this->name = $name;
	}

	public function apply($model, RepositoryInterface $repository)
	{
		return $model->where('name', $this->name);
	}
}