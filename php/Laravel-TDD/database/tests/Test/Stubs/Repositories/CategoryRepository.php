<?php

namespace Test\Stubs\Repositories;

use ChimeraRocks\Database\AbstractRepository;
use Test\Stubs\Models\Category;

class CategoryRepository extends AbstractRepository
{
	public function model()
	{
		return Category::class;
	}
}