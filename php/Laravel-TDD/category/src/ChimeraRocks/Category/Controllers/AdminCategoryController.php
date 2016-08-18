<?php

namespace ChimeraRocks\Category\Controllers;

use ChimeraRocks\Category\Repositories\CategoryRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
	private $categoryRepository;
	private $response;

	public function __construct(CategoryRepository $categoryRepository, ResponseFactory $response)
	{
		$this->categoryRepository = $categoryRepository;
		$this->response = $response;
	}

	public function index()
	{
		return $this->response->view('chimeracategory::index', [
			'categories' => $this->categoryRepository->all()
		]);
	}

	public function create()
	{
		$categories = $this->categoryRepository->all();
		return $this->response->view('chimeracategory::create', compact('categories'));
	}

	public function store(Request $request)
	{
		$this->categoryRepository->create($request->all());
		return redirect()->route('admin.categories.index');
	}
}