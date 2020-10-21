<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Http\Response;

class PostController extends Controller
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
        $posts = $this->postService->all('post', true, null, true);
        
        return view('admin.post.index')->withPosts($posts);
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

        return view('admin.post.create')->withCategories($categories);
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
            'title' => ['required', 'unique:posts', ],
            'details' => ['required', ],
            'categories' => ['required', ],
        ]);

        $post = $this->postService->create($request);

        return redirect()->to(route('posts.index'));
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
    public function update(Request $request, $id)
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
        //
    }
}
