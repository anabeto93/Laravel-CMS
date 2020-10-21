<?php

namespace App\Repositories\Post;


use App\Models\Category;
use App\Models\Post;
use Debugbar;

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

    public function all($type='post', $limit=null)
    {
        if (!$limit) {
            return Post::where('post_type', $type)->get();
        }

        return Post::where('post_type', $type)->limit($limit)->get();
    }

    public function latest($type='post', $limit=null)
    {
        if (!$limit) {
            return Post::where('post_type', $type)->latest()->get();
        }

        return Post::latest()->where('post_type', $type)->limit($limit)->get();
    }
}
