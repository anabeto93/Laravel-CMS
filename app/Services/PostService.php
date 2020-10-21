<?php

namespace App\Services;


use App\Models\Category;
use App\Repositories\Post\PostContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostService
{
    /** @var PostContract */
    private $post;

    public function __construct(PostContract $postContract)
    {
        $this->post = $postContract;
    }

    public function getPublishedPosts()
    {
        return $this->post->publishedPosts();
    }

    public function findBySlug(string $slug)
    {
        if (!$slug) return null;

        return $this->post->findBySlug($slug);
    }

    public function getCategoryPosts(Category $category)
    {
        return $this->post->getCategoryPosts($category);
    }

    public function all($type='post', $latest=false, $limit=null, $paginate=false)
    {
        if (!$latest) {
            return $this->post->all($type, $limit, $paginate);
        }

        return $this->post->latest($type, $limit, $paginate);
    }

    public function create(Request $request)
    {
        $data = $request->only('thumbnail', 'title', 'details', 'categories', 'sub_title', 'is_published', 'slug');

        if (!array_key_exists('slug', $data)) {
            $data['slug'] = str_slug($data['title']);
        }

        Session::flash('message', 'Post successfully created.');

        return $this->post->create($data);
    }
}
