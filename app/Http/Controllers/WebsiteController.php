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

    public function post($slug)
    {
        $post = $this->postService->findBySlug($slug);

        if (!$post) {
            //return view('website.errors.404', [], 404);
            abort(404);
        }
        return view('website.post')->withPost($post);
    }

    public function category($slug)
    {
        $category = $this->categoryService->findBySlug($slug);

        if (!$category) {
            abort(404);
        }

        $posts = $this->postService->getCategoryPosts($category);

        return view('website.category')->withCategory($category)->withPosts($posts);
    }
}
