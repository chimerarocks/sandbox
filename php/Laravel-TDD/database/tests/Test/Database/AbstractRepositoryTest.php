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
}