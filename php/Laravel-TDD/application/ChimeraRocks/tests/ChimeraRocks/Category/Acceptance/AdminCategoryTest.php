<?php

namespace ChimeraRocks\Category\Acceptance\Testing;

class AdminCategoryTest extends \TestCase
{
	public function test_can_visit_admin_categories_page()
	{
		$this->visit('/admin/categories')
			->see('Categories');
	}

}