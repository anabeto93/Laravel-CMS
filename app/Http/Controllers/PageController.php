<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Http\Response;
use App\Services\CategoryService;

class PageController extends Controller
{
    /** @var PostService */
    private $postService;

    /** @var CategoryService */
    private $categoryService;

    public function __construct(PostService $postService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = $this->postService->all('page', true, null, true);
        
        return view('admin.page.index')->withPages($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->categoryService->all();

        if ($categories) {
            $categories = $categories->pluck('name', 'id');
        }

        return view('admin.page.create')->withCategories($categories);
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
            "thumbnail" => 'required',
            "title" => 'required|unique:posts',
            "details" => "required",
        ],
            [
                'thumbnail.required' => 'Enter thumbnail url',
                'title.required' => 'Enter title',
                'title.unique' => 'Title already exist',
                'details.required' => 'Enter details',
            ]
        );

        $request->merge(['post_type' => 'page']);

        $page = $this->postService->create($request);

        return redirect()->to(route('pages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postService->find($id);

        if (!$post) {
            abort(404);
        }
        
        $categories = $this->categoryService->all();

        if ($categories) {
            $categories = $categories->pluck('name', 'id');
        }

        return view('admin.page.edit')->withPage($post)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "thumbnail" => 'required',
            'title' => 'required|unique:posts,title,' . $id . ',id',
            'details' => 'required',
            ],
            [
                'thumbnail.required' => 'Enter thumbnail url',
                'title.required' => 'Enter title',
                'title.unique' => 'Title already exist',
                'details.required' => 'Enter details',
        ]);

        $request->merge(['post_type' => 'page']);

        $post = $this->postService->update($id, $request);

        return redirect()->to(route('pages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->postService->delete($id);

        return redirect()->to(route('pages.index'));
    }
}
