<?php

namespace Test\Stubs\Criterias;

use ChimeraRocks\Database\Contracts\CriteriaInterface;
use ChimeraRocks\Database\Contracts\RepositoryInterface;

class OrderDescById implements CriteriaInterface
{
	public function apply($model, RepositoryInterface $repository)
	{
		return $model->orderBy('id', 'desc');
	}
}