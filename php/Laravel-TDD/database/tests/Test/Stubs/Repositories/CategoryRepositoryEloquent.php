<?php

namespace Test\Stubs\Repositories;

use ChimeraRocks\Database\AbstractRepository;
use Test\Stubs\Models\Category;
use Test\Stubs\Repositories\CategoryRepositoryInterface;

class CategoryRepositoryEloquent extends AbstractRepository implements CategoryRepositoryInterface
{
	public function model()
	{
		return Category::class;
	}
}