<?php

namespace Test\Database;

use Illuminate\Database\Eloquent\Builder;
use Mockery;
use Test\AbstactTestCase;
use Test\Stubs\Models\Category;
use Test\Stubs\Repositories\CategoryRepositoryEloquent;

class CriteriaInterfaceTest extends AbstactTestCase
{
	public function test_should_apply()
	{
		$mockQueryBuilder = Mockery::mock(Builder::class);
		$mockRepository = Mockery::mock(CategoryRepositoryEloquent::class);
		$mockModel = Mockery::mock(Category::class);
		$mock = Mockery::mock(AbstractCriteria::class);
		$mock->shouldReceive('apply')
			->with($mockModel, $mockRepository)
			->andReturn($mockQueryBuilder);

		$this->assertInstanceOf(Builder::class, $mock->apply($mockModel, $mockRepository));
	}
}