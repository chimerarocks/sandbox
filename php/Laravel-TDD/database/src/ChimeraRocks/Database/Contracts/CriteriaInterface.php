<?php

namespace ChimeraRocks\Database\Contracts;

use ChimeraRocks\Database\Contracts\RepositoryInterface;

interface CriteriaInterface
{
	public function apply($model, RepositoryInterface $repository);
}