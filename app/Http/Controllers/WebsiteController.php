<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use App\Services\CategoryService;

class WebsiteController extends Controller
{
    /** @var CategoryService  */
    private $categoryService;

    /** @var PostService */
    private $postService;

    public function __construct(CategoryService $categoryService, PostService $postService)
    {
        $this->categoryService = $categoryService;
        $this->postService = $postService;
    }

    public function index()
    {
        $categories = $this->categoryService->getPublishedCategories();
        $posts = $this->postService->getPublishedPosts();

        return view('website.index')->withPosts($posts)->withCategories($categories);
    }
}