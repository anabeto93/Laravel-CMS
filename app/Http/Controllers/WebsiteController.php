<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Services\CategoryService;

class WebsiteController extends Controller
{
    /** @var CategoryService  */
    private $categoryService;

    /** @var PostService */
    private $postService;

    /** @var ContactService  */
    private $contactService;

    public function __construct(CategoryService $categoryService, PostService $postService, ContactService $contactService)
    {
        $this->categoryService = $categoryService;
        $this->postService = $postService;
        $this->contactService = $contactService;
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

    public function page($slug)
    {
        $page = $this->postService->findBySlug($slug, 'page');

        if (!$page) {
            abort(404);
        }

        return view('website.page')->withPage($page);
    }

    public function showContactForm()
    {
        return view('website.contact');
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name' => ['required',],
            'email' => ['required', 'email',],
            'phone' => ['required',],
            'message' => ['required',],
        ]);

        $this->contactService->sendMail($request);

        return redirect()->to(route('contact.show'));
    }
}
