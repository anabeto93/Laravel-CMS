<?php

namespace App\Services;


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
}
