<?php

namespace ChimeraRocks\Category\Repositories;

use ChimeraRocks\Category\Models\Category;
use ChimeraRocks\Database\AbstractRepository;

class CategoryRepository extends AbstractRepository
{
	public function model()
	{
		return Category::class;
	}
}