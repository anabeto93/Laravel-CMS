<?php

namespace App\Repositories\Post;


interface PostContract
{
    public function publishedPosts();

    public function findBySlug(string $slug);
}
