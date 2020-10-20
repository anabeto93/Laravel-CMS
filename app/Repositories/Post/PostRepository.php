<?php

namespace App\Repositories\Post;


use App\Models\Post;

class PostRepository implements PostContract
{
    public function publishedPosts()
    {
        return Post::published()->where('post_type', 'post')->orderBy('id', 'DESC')->paginate(5);
    }
}
