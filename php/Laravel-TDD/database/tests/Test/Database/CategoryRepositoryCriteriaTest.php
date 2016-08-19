<?php

namespace Test\Database;

use ChimeraRocks\Database\Contracts\CriteriaCollectionInterface;
use ChimeraRocks\Database\Contracts\CriteriaInterface;
use Mockery;
use Test\AbstactTestCase;
use Test\Stubs\Criterias\FindByDescription;
use Test\Stubs\Criterias\FindByName;
use Test\Stubs\Criterias\FindByNameAndDescription;
use Test\Stubs\Criterias\OrderDescById;
use Test\Stubs\Criterias\OrderDescByName;
use Test\Stubs\Models\Category;
use Test\Stubs\Repositories\CategoryRepositoryEloquent;

class CategoryRepositoryCriteriaTest extends AbstactTestCase
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

	public function test_if_implements_criteria_collection_interface()
	{
		$this->assertInstanceOf(CriteriaCollectionInterface::class, $this->repository);
	}

	public function test_can_get_criteria_collection()
	{
		$result = $this->repository->getCriteriaCollection();
		$this->assertCount(0, $result);
	}

	public function test_can_add_criteria()
	{
		$mock = Mockery::mock(CriteriaInterface::class);
		$result = $this->repository->addCriteria($mock);

		$this->assertInstanceOf(CategoryRepositoryEloquent::class, $result);
		$this->assertCount(1, $this->repository->getCriteriaCollection());
	}

	public function test_can_get_by_criteria()
	{
		$criteria = new FindByNameAndDescription('Category1', 'description1');
		$repository = $this->repository->getByCriteria($criteria);

		$this->assertInstanceOf(CategoryRepositoryEloquent::class, $repository);

		$result = $repository->all();

		$this->assertCount(1, $result);
		$result = $result->first();
		$this->assertEquals('Category1', $result->name);
		$this->assertEquals('description1', $result->description);

	}

	public function test_can_apply_criteria()
	{
		$this->createCategoriesDescriptions();

		$criteria1 = new FindByDescription('description');
		$criteria2 = new OrderDescByName;
		
		$this->repository
			->addCriteria($criteria1)
			->addCriteria($criteria2);

		$repository = $this->repository->applyCriteria();

		$this->assertInstanceOf(CategoryRepositoryEloquent::class, $repository);

		$result = $repository->all();

		$this->assertCount(2, $result);
		$this->assertEquals($result[0]->name, 'Category Um');
		$this->assertEquals($result[1]->name, 'Category Dois');
	}

	public function test_can_list_all_categories_with_criteria()
	{
		$this->createCategoriesDescriptions();

		$criteria1 = new FindByDescription('description');
		$criteria2 = new OrderDescByName;
		
		$this->repository
			->addCriteria($criteria1)
			->addCriteria($criteria2);

		$result = $this->repository->all();

		$this->assertCount(2, $result);
		$this->assertEquals($result[0]->name, 'Category Um');
		$this->assertEquals($result[1]->name, 'Category Dois');
	}


	/**
	 * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function test_can_find_categories_with_criteria_throws_exception()
	{
		$this->createCategoriesDescriptions();

		$criteria1 = new FindByDescription('description');
		$criteria2 = new FindByName('Category Dois');
		
		$this->repository
			->addCriteria($criteria1)
			->addCriteria($criteria2);

		$this->repository->find(3);
	}

	public function test_can_find_categories_with_criteria()
	{
		$this->createCategoriesDescriptions();

		$criteria1 = new FindByDescription('description');
		$criteria2 = new FindByName('Category Dois');
		
		$this->repository
			->addCriteria($criteria1)
			->addCriteria($criteria2);

		$result = $this->repository->find(5);
		$this->assertEquals($result->name, 'Category Dois');
	}

	public function test_can_findby_categories_with_criteria()
	{
		$this->createCategoriesDescriptions();
		$this->createCategoriesDescriptions();

		$criteria1 = new FindByName('Category Dois');
		$criteria2 = new OrderDescById();
		
		$this->repository
			->addCriteria($criteria1)
			->addCriteria($criteria2);

		$result = $this->repository->findBy('description', 'description');
		$this->assertCount(2, $result);
		$this->assertEquals(7, $result[0]->id);
		$this->assertEquals(5, $result[1]->id);
	}

	public function test_can_ignore_criteria()
	{
		$reflectionClass = new \ReflectionClass($this->repository);
		$reflectionProperty = $reflectionClass->getProperty('isIgnoreCriteria');
		$reflectionProperty->setAccessible(true);
		$result = $reflectionProperty->getValue($this->repository);
		$this->assertFalse($result);

		$this->repository->ignoreCriteria();
		$result = $reflectionProperty->getValue($this->repository);
		$this->assertTrue($result);

		$this->repository->ignoreCriteria(true);
		$result = $reflectionProperty->getValue($this->repository);
		$this->assertTrue($result);

		$this->repository->ignoreCriteria(false);
		$result = $reflectionProperty->getValue($this->repository);
		$this->assertFalse($result);

		$this->assertInstanceOf(CategoryRepositoryEloquent::class, $this->repository->ignoreCriteria(false));
	}

	public function test_can_ignore_criteria_with_apply_criteria()
	{
		$this->createCategoriesDescriptions();

		$criteria1 = new FindByDescription('description');
		$criteria2 = new OrderDescByName;
		

		$this->repository
			->addCriteria($criteria1)
			->addCriteria($criteria2);

		$this->repository->ignoreCriteria();
		$repository = $this->repository->applyCriteria();
		$reflectionClass = new \ReflectionClass($this->repository);
		$reflectionProperty = $reflectionClass->getProperty('model');
		$reflectionProperty->setAccessible(true);
		$result = $reflectionProperty->getValue($this->repository);
		$this->assertInstanceOf(Category::class, $result);

		$this->repository->ignoreCriteria(false);
		$repository = $this->repository->applyCriteria();
		$this->assertInstanceOf(CategoryRepositoryEloquent::class, $repository);

		$result = $repository->all();

		$this->assertCount(2, $result);
		$this->assertEquals($result[0]->name, 'Category Um');
		$this->assertEquals($result[1]->name, 'Category Dois');
	}

	public function test_can_clear_criterias()
	{
		$this->createCategoriesDescriptions();
		$this->createCategoriesDescriptions();

		$criteria1 = new FindByName('Category Dois');
		$criteria2 = new OrderDescById();
		
		$this->repository
			->addCriteria($criteria1)
			->addCriteria($criteria2);

		$this->repository->clearCriteria();

		$result = $this->repository->findBy('description', 'description');
		$this->assertCount(4, $result);
		$this->assertEquals(5, $result[0]->id);
		$this->assertEquals(6, $result[1]->id);

		$reflectionClass = new \ReflectionClass($this->repository);
		$reflectionProperty = $reflectionClass->getProperty('model');
		$reflectionProperty->setAccessible(true);
		$result = $reflectionProperty->getValue($this->repository);
		$this->assertInstanceOf(Category::class, $result);
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

	private function createCategoriesDescriptions()
	{
		Category::create([
			'name' => 'Category Dois',
			'description' => 'description'
		]);
		Category::create([
			'name' => 'Category Um',
			'description' => 'description'
		]);
	}
}