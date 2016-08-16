<?php

namespace ChimeraRocks\Tag\Acceptance\Testing;

use ChimeraRocks\Tag\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTagTest extends \TestCase
{
	use DatabaseTransactions;

	public function test_can_visit_admin_tags_page()
	{
		$this->visit('/admin/tags')
			->see('Tags');
	}

	public function test_tags_listing()
	{
		Tag::create(['name' => 'Tag1']);
		Tag::create(['name' => 'Tag2']);
		Tag::create(['name' => 'Tag3']);
		Tag::create(['name' => 'Tag4']);

		$this->visit('/admin/tags')
			->see('Tag1')
			->see('Tag2')
			->see('Tag3')
			->see('Tag4');
	}

	public function test_click_create_new_tag()
	{
		$this->visit('/admin/tags')
			->click('Create')
			->seePageIs('/admin/tags/create');
	}

	public function test_create_new_tag()
	{
		$this->visit('/admin/tags/create')
			->type('Tag Test', 'name')
			->press('Create')
			->seePageIs('/admin/tags')
			->see('Tag Test');
	}
}