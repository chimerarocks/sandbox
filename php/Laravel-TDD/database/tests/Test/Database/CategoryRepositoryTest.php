<?php

namespace Test\Database;

use Test\AbstactTestCase;
use Test\Stubs\Models\Category;
use Test\Stubs\Repositories\CategoryRepositoryEloquent;

class CategoryRepositoryTest extends AbstactTestCase
{
	/**
	 * @var Test\Stubs\Repositories\CategoryRepositoryEloquent
	 */
	private $repository;

	public function setUp()
	{
		parent::setUp();
		$this->migrate();
		$this->repository = new CategoryRepositoryEloquent;
		$this->createCategories();
	}

	public function test_can_model()
	{
		$this->assertEquals(Category::class, $this->repository->model());
	}

	public function test_can_makemodel()
	{
		$result = $this->repository->makeModel();
		$this->assertInstanceOf(Category::class, $result);

		$reflectionClass = new \ReflectionClass($this->repository);
		$reflectionProperty = $reflectionClass->getProperty('model');
		$reflectionProperty->setAccessible(true);
		$result = $reflectionProperty->getValue($this->repository);
		$this->assertInstanceOf(Category::class, $result);
	}

	public function test_can_make_model_in_constructor()
	{
		
		$reflectionClass = new \ReflectionClass($this->repository);
		$reflectionProperty = $reflectionClass->getProperty('model');
		$reflectionProperty->setAccessible(true);
		$result = $reflectionProperty->getValue($this->repository);
		$this->assertInstanceOf(Category::class, $result);	
	}

	public function test_can_list_all_categories()
	{
		$result = $this->repository->all();
		$this->assertCount(4, $result);

		$result = $this->repository->all(['name']);
		$this->assertNull($result[0]->description);
		$this->assertNotNull($result[0]->name);
	}

	public function test_can_create_category()
	{
		$result = $this->repository->create([
			'name' => 'Category5',
			'description' => 'description5'
		]);
		
		$this->assertInstanceOf(Category::class, $result);
		$this->assertEquals('Category5', $result->name);
		$this->assertEquals('description5', $result->description);

		$result = Category::find(5);
		$this->assertEquals('Category5', $result->name);
		$this->assertEquals('description5', $result->description);
	}

	public function test_can_update_category()
	{
		$result = $this->repository->update([
			'name' => 'Category5',
			'description' => 'description5'
		], 1);
		
		$this->assertInstanceOf(Category::class, $result);
		$this->assertEquals('Category5', $result->name);
		$this->assertEquals('description5', $result->description);

		$result = Category::find(1);
		$this->assertEquals('Category5', $result->name);
		$this->assertEquals('description5', $result->description);
	}

	/**
	 * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function test_update_category_fails()
	{
		$result = $this->repository->update([
			'name' => 'Category5',
			'description' => 'description5'
		], 10);
	}


	public function test_can_delete_category()
	{
		$result = $this->repository->delete(1);
		$categories = Category::all();
		
		$this->assertCount(3, $categories);
		$this->assertTrue($result);
	}

	/**
	 * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function test_delete_category_fails()
	{
		$result = $this->repository->delete(10);
	}

	public function test_can_find_category()
	{
		$result = $this->repository->find(1);
		$this->assertInstanceOf(Category::class, $result);
	}

	public function test_can_find_category_with_columns()
	{
		$result = $this->repository->find(1, ['name']);
		$this->assertInstanceOf(Category::class, $result);
		$this->assertNull($result->description);
		$this->assertNotNull($result->name);
	}

	/**
	 * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function test_find_category_fails()
	{
		$result = $this->repository->find(10);
	}

	public function test_can_find_categories()
	{
		$result = $this->repository->findBy('name', 'Category1');
		$this->assertCount(1, $result);
		$this->assertInstanceOf(Category::class, $result[0]);
		$this->assertEquals('Category1', $result[0]->name);

		$result = $this->repository->findBy('name', 'Category10');
		$this->assertCount(0, $result);

		$result = $this->repository->findBy('name', 'Category1', ['name']);
		$this->assertCount(1, $result);
		$this->assertInstanceOf(Category::class, $result[0]);
		$this->assertEquals('Category1', $result[0]->name);
		$this->assertNull($result[0]->description);
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