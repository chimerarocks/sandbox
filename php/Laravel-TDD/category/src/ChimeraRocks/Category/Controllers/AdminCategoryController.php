<?php

namespace ChimeraRocks\Category\Controllers;

use ChimeraRocks\Category\Models\Category;

class AdminCategoryController extends Controller
{
	private $category;

	public function __construct(Category $category)
	{
		$this->category = $category;
	}

	public function index()
	{
		return view('chimeracategory::index', ['categories' => $this->category->all()]);
	}

	public function create()
	{
		return view('codecategory::create');
	}
}