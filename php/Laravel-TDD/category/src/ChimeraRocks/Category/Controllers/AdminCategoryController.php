<?php

namespace ChimeraRocks\Category\Controllers;

use ChimeraRocks\Category\Models\Category;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
	private $category;
	private $response;

	public function __construct(Category $category, ResponseFactory $response)
	{
		$this->category = $category;
		$this->response = $response;
	}

	public function index()
	{
		return $this->response->view('chimeracategory::index', ['categories' => $this->category->all()]);
	}

	public function create()
	{
		$categories = $this->category->all();
		return $this->response->view('chimeracategory::create', compact('categories'));
	}

	public function store(Request $request)
	{
		$this->category->create($request->all());
		return redirect()->route('admin.categories.index');
	}
}