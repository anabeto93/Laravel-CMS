<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** @var CategoryService  */
    private $categoryService;

    /** @var PostService  */
    private $postService;

    /**
     * Create a new controller instance.
     *
     * @param CategoryService $categoryService
     * @param PostService $postService
     */
    public function __construct(CategoryService $categoryService, PostService $postService)
    {
        $this->middleware('auth');
        $this->categoryService = $categoryService;
        $this->postService = $postService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = $this->categoryService->all(true, 3);
        $posts = $this->postService->all('post',true, 3);
        $pages = $this->postService->all('page', true, 3);
        return view('admin.index')->withCategories($categories)->withPosts($posts)->withPages($pages);
    }
}
