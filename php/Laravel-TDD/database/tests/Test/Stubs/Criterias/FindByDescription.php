<?php

namespace Test\Stubs\Criterias;

use ChimeraRocks\Database\Contracts\CriteriaInterface;
use ChimeraRocks\Database\Contracts\RepositoryInterface;

class FindByDescription implements CriteriaInterface
{
	private $description;

	public function __construct($description)
	{

		$this->description = $description;
	}

	public function apply($model, RepositoryInterface $repository)
	{
		return $model->where('description', $this->description);
	}
}