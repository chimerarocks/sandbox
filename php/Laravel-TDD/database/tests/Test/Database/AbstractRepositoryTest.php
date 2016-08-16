<?php

namespace Test\Database;

use ChimeraRocks\Database\AbstractRepository;
use ChimeraRocks\Database\Contracts\RepositoryInterface;
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
}