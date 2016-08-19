<?php

namespace Test\Stubs\Criterias;

use ChimeraRocks\Database\Contracts\CriteriaInterface;
use ChimeraRocks\Database\Contracts\RepositoryInterface;

class OrderDescByName implements CriteriaInterface
{
	public function apply($model, RepositoryInterface $repository)
	{
		return $model->orderBy('name', 'desc');
	}
}