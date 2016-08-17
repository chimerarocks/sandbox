<?php

namespace Test\Database;

use ChimeraRocks\Database\AbstractRepository;
use ChimeraRocks\Database\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery;
use Test\AbstactTestCase;
use Test\Stubs\Models\Category;

class AbstractRepositoryTest extends AbstactTestCase
{

	public function test_if_implements_repository_interface()
	{
		$mock = Mockery::mock(AbstractRepository::class);

		$this->assertInstanceOf(RepositoryInterface::class, $mock);
	}

	public function test_it_should_returns_all_whitout_arguments()
	{
		$mockRepository = Mockery::mock(AbstractRepository::class);
		$mockStd = Mockery::mock(\stdClass::class);
		$mockStd->id = 1;
		$mockStd->name = 'name';
		$mockStd->description = 'description';

		$mockRepository
		    ->shouldReceive('all')
		    ->andReturn([$mockStd, $mockStd, $mockStd]);

		$this->assertCount(3, $mockRepository->all());
		$this->assertInstanceOf(\stdClass::class, $mockRepository->all()[0]);
	}

	public function test_it_should_returns_all_whit_arguments()
	{
		$mockRepository = Mockery::mock(AbstractRepository::class);
		$mockStd = Mockery::mock(\stdClass::class);
		$mockStd->id = 1;
		$mockStd->name = 'name';
		$mockStd->description = 'description';

		$mockRepository
		    ->shouldReceive('all')
		    ->with(['id', 'name'])
		    ->andReturn([$mockStd, $mockStd, $mockStd]);

		$this->assertCount(3, $mockRepository->all(['id', 'name']));
		$this->assertInstanceOf(\stdClass::class, $mockRepository->all(['id', 'name'])[0]);
	}

	public function test_it_should_returns_create()
	{
		$mockRepository = Mockery::mock(AbstractRepository::class);
		$mockStd = Mockery::mock(\stdClass::class);
		$mockStd->id = 1;
		$mockStd->name = 'name';

		$mockRepository
		    ->shouldReceive('create')
		    ->with(['name' => 'stdClassName'])
		    ->andReturn($mockStd);

		$result = $mockRepository->create(['name' => 'stdClassName']);
		$this->assertEquals(1, $result->id);
		$this->assertInstanceOf(\stdClass::class, $result);
	}

	public function test_it_should_update_succeed()
	{
		$mockRepository = Mockery::mock(AbstractRepository::class);
		$mockStd = Mockery::mock(\stdClass::class);
		$mockStd->id = 1;
		$mockStd->name = 'name';

		$mockRepository
		    ->shouldReceive('update')
		    ->with(['name' => 'stdClassName'], 1)
		    ->andReturn($mockStd);

		$result = $mockRepository->update(['name' => 'stdClassName'], 1);
		$this->assertEquals(1, $result->id);
		$this->assertInstanceOf(\stdClass::class, $result);
	}

	/**
	 * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function test_it_should_update_fails()
	{
		$mockRepository = Mockery::mock(AbstractRepository::class);
		$throw = new ModelNotFoundException;
		$throw->setModel(\stdClass::class);

		$mockRepository
		    ->shouldReceive('update')
		    ->with(['name' => 'stdClassName'], 0)
		    ->andThrow($throw);

		$mockRepository->update(['name' => 'stdClassName'], 0);
	}

	public function test_it_should_delete_succeed()
	{
		$mockRepository = Mockery::mock(AbstractRepository::class);

		$mockRepository
		    ->shouldReceive('delete')
		    ->with(1)
		    ->andReturn(true);

		$result = $mockRepository->delete(1);
		$this->assertTrue($result);
	}

	/**
	 * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function test_it_should_delete_fails()
	{
		$mockRepository = Mockery::mock(AbstractRepository::class);
		$throw = new ModelNotFoundException;
		$throw->setModel(\stdClass::class);

		$mockRepository
		    ->shouldReceive('delete')
		    ->with(0)
		    ->andThrow($throw);

		$mockRepository->delete(0);
	}

	public function test_it_should_find_whitout_columns_succeed()
	{
		$mockRepository = Mockery::mock(AbstractRepository::class);
		$mockStd = Mockery::mock(\stdClass::class);
		$mockStd->id = 1;
		$mockStd->name = 'name';
		$mockStd->description = 'description';

		$mockRepository
		    ->shouldReceive('find')
		    ->with(1)
		    ->andReturn($mockStd);

		$result = $mockRepository->find(1);
		$this->assertInstanceOf(\stdClass::class, $result);
	}

	public function test_it_should_find_whit_columns_succeed()
	{
		$mockRepository = Mockery::mock(AbstractRepository::class);
		$mockStd = Mockery::mock(\stdClass::class);
		$mockStd->id = 1;
		$mockStd->name = 'name';

		$mockRepository
		    ->shouldReceive('find')
		    ->with(1, ['id', 'name'])
		    ->andReturn($mockStd);

		$result = $mockRepository->find(1, ['id', 'name']);
		$this->assertInstanceOf(\stdClass::class, $result);
	}

	/**
	 * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function test_it_should_find_fails()
	{
		$mockRepository = Mockery::mock(AbstractRepository::class);
		$throw = new ModelNotFoundException;
		$throw->setModel(\stdClass::class);

		$mockRepository
		    ->shouldReceive('find')
		    ->with(0)
		    ->andThrow($throw);

		$result = $mockRepository->find(0);
	}

	public function test_it_should_findby_whit_columns_succeed()
	{
		$mockRepository = Mockery::mock(AbstractRepository::class);
		$mockStd = Mockery::mock(\stdClass::class);
		$mockStd->id = 1;
		$mockStd->name = 'name';

		$mockRepository
		    ->shouldReceive('findBy')
		    ->with('name', 'my-data',['id', 'name'])
		    ->andReturn([$mockStd, $mockStd, $mockStd]);

		$result = $mockRepository->findBy('name', 'my-data',['id', 'name']);
		$this->assertCount(3, $result);
		$this->assertInstanceOf(\stdClass::class, $result[0]);
	}

	public function test_it_should_findby_empty_succeed()
	{
		$mockRepository = Mockery::mock(AbstractRepository::class);
		$mockStd = Mockery::mock(\stdClass::class);
		$mockStd->id = 1;
		$mockStd->name = 'name';

		$mockRepository
		    ->shouldReceive('findBy')
		    ->with('name', '',['id', 'name'])
		    ->andReturn([]);

		$result = $mockRepository->findBy('name', '',['id', 'name']);
		$this->assertCount(0, $result);
	}

}
