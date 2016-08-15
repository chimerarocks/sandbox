<?php

namespace ChimeraRocks\Category\Controllers;

use ChimeraRocks\Category\Models\Category;
use Illuminate\Http\Request;

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
		$categories = $this->category->all();
		return view('chimeracategory::create', compact('categories'));
	}

	public function store(Request $request)
	{
		$this->category->create($request->all());
		return redirect()->route('admin.categories.index');
	}
}