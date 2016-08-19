<?php

namespace ChimeraRocks\Category\Repositories;

use ChimeraRocks\Category\Models\Category;
use ChimeraRocks\Category\Repositories\CategoryRepositoryInterface;
use ChimeraRocks\Database\AbstractRepository;

class CategoryRepositoryEloquent extends AbstractRepository implements CategoryRepositoryInterface
{
	public function model()
	{
		return Category::class;
	}
}