<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /** @var CategoryService */
    private $categoryService;

    public function __construct(CategoryService $categoryService) 
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->categoryService->all(true);

        return view('admin.category.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => ['required',],
            'name' => ['required', 'unique:categories',],
            'is_published' => ['required',],
        ], [
            'thumbnail.required' => 'Enter thumbnail url',
            'name.required' => 'Category name is required.',
            'name.unique' => 'Category name already exists.',
        ]);

        $category = $this->categoryService->create($request);

        return redirect()->to(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param string|int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string|int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string|int $id
     * @return Response
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string|int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->categoryService->delete($id);

        return redirect()->to(route('categories.index'));
    }
}
