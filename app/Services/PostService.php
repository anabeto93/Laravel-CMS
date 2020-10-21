<?php

namespace App\Services;


use App\Models\Category;
use App\Repositories\Post\PostContract;

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

    public function all($type='post', $latest=false, $limit=null)
    {
        if (!$latest) {
            return $this->post->all($type, $limit);
        }

        return $this->post->latest($type, $limit);
    }
}
