<?php

namespace Test\Database;

use ChimeraRocks\Database\AbstractRepository;
use ChimeraRocks\Database\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery;
use Test\AbstactTestCase;

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
		$this->assertTrue($result);
	}
}
