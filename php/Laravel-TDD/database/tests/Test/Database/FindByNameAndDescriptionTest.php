<?php

namespace Test\Database;

use ChimeraRocks\Database\Contracts\CriteriaInterface;
use Illuminate\Database\Eloquent\Builder;
use Test\AbstactTestCase;
use Test\Stubs\Criterias\FindByNameAndDescription;
use Test\Stubs\Models\Category;
use Test\Stubs\Repositories\CategoryRepositoryEloquent;

class FindByNameAndDescriptionTest extends AbstactTestCase
{
	/**
	 * @var Test\Stubs\Repositories\CategoryRepositoryEloquent
	 */
	private $repository;

	/**
	 * @var Test\Stubs\Criterias\FindByNameAndDescription
	 */
	private $criteria;

	public function setUp()
	{
		parent::setUp();
		$this->migrate();
		$this->repository = new CategoryRepositoryEloquent;
		$this->criteria = new FindByNameAndDescription('Category1', 'description1');
		$this->createCategories();
	}

	public function test_if_implements_criteria_interface()
	{
		$this->assertInstanceOf(CriteriaInterface::class, $this->criteria);
	}

	public function test_if_apply_returns_query_builder()
	{
		$class = $this->repository->model();
		$result = $this->criteria->apply(new $class, $this->repository);

		$this->assertInstanceOf(Builder::class, $result);
	}

	public function test_if_apply_returns_data()
	{
		$class = $this->repository->model();
		$result = $this->criteria->apply(new $class, $this->repository)->get()->first();

		$this->assertEquals('Category1', $result->name);
		$this->assertEquals('description1', $result->description);
	}

	private function createCategories()
	{
		Category::create([
			'name' => 'Category1',
			'description' => 'description1'
		]);
		Category::create([
			'name' => 'Category2',
			'description' => 'description2'
		]);
		Category::create([
			'name' => 'Category3',
			'description' => 'description3'
		]);
		Category::create([
			'name' => 'Category4',
			'description' => 'description4'
		]);
	}
}