<?php

namespace Test\Tag\Models;

use ChimeraRocks\Tag\Models\Tag;
use Test\AbstactTestCase;

class TagTest extends AbstactTestCase
{
	public function setUp()
	{
		parent::setUp();
		$this->migrate();
	}

	public function test_check_if_a_tag_can_be_persisted()
	{
		$tag = Tag::create(['name' => 'TagTest']);

		$this->assertEquals('TagTest', $tag->name);

		$tag = Tag::all()->first();

		$this->assertEquals('TagTest', $tag->name);
	}
}