<?php

namespace Test\Category\Controllers;

use ChimeraRocks\Category\Controllers\AdminCategoryController;
use ChimeraRocks\Category\Controllers\Controller;
use ChimeraRocks\Category\Models\Category;
use Test\AbstactTestCase;
use Mockery;

class AdminCategoryControllerTest extends AbstactTestCase
{
	public function test_shlud_extends_from_controller()
	{
		$category = Mockery::mock(Category::class);
		$controller = new AdminCategoryController($category);

		$this->assertInstanceOf(Controller::class, $controller);
	}
}