<?php

namespace ChimeraRocks\Category\Acceptance\Testing;

use ChimeraRocks\Category\Models\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminCategoryTest extends \TestCase
{
	use DatabaseTransactions;

	public function test_can_visit_admin_categories_page()
	{
		$this->visit('/admin/categories')
			->see('Categories');
	}

	public function test_categories_listing()
	{
		Category::create(['name' => 'Category1', 'active' => true]);
		Category::create(['name' => 'Category2', 'active' => true]);
		Category::create(['name' => 'Category3', 'active' => true]);
		Category::create(['name' => 'Category4', 'active' => true]);

		$this->visit('/admin/categories')
			->see('Category1')
			->see('Category2')
			->see('Category3')
			->see('Category4');
	}

	public function test_click_create_new_category()
	{
		$this->visit('/admin/categories')
			->click('Create')
			->seePageIs('/admin/categories/create');
	}

	public function test_create_new_category()
	{
		$this->visit('/admin/categories/create')
			->type('Category Test', 'name')
			->check('active')
			->press('Submit')
			->seePageIs('/admin/categories');
			->see('')
	}
}