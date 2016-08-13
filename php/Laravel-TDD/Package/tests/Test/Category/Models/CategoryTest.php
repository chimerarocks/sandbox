<?php

namespace Test\Category\Models;

use ChimeraRocks\Category\Models\Category;
use Test\AbstactTestCase;

class CategoryTest extends AbstactTestCase
{
	public function setUp()
	{
		parent::setUp();
		$this->migrate();
	}

	public function test_check_if_a_category_can_be_persisted()
	{
		$category = Category::create(['name' => 'CategoryTest', 'active' => true]);

		$this->assertEquals('CategoryTest', $category->name);

		$category = Category::all()->first();

		$this->assertEquals('CategoryTest', $category->name);
	}

	public function test_check_if_can_assign_a_parent_to_a_category()
	{
		$parentCategory = Category::create(['name' => 'ParentTest', 'active' => true]);
		$category = Category::create(['name' => 'CategoryTest', 'active' => true]);

		$category->parent()->associate($parentCategory)->save();

		$child = $parentCategory->children->first();

		$this->assertEquals('CategoryTest', $child->name);
		$this->assertEquals('ParentTest', $child->parent->name);
	}
}