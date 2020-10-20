<?php

namespace App\Repositories\Post;


use App\Models\Category;
use App\Models\Post;

class PostRepository implements PostContract
{
    public function publishedPosts()
    {
        return Post::published()->where('post_type', 'post')->orderBy('id', 'DESC')->paginate(5);
    }

    public function findBySlug(string $slug)
    {
        return Post::published()->where('slug', $slug)->where('post_type', 'post')->first();
    }

    /**
     * @param Category $category
     */
    public function getCategoryPosts($category)
    {
        return $category->posts()->published()->orderBy('posts.id', 'DESC')->paginate(5);
    }
}
