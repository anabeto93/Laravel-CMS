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

    public function all($type='post', $limit=null, $paginate=false, $page_count=25)
    {
        if (!$limit) {
            if ($paginate) {
                return Post::where('post_type', $type)->paginate($page_count);
            }

            return Post::where('post_type', $type)->get();
        }

        if ($paginate) {
            return Post::where('post_type', $type)->limit($limit)->paginate($page_count);
        }

        return Post::where('post_type', $type)->limit($limit)->get();
    }

    public function latest($type='post', $limit=null, $paginate=false, $page_count=25)
    {
        if (!$limit) {

            if ($paginate) {
                return Post::where('post_type', $type)->latest()->paginate($page_count);
            }

            return Post::where('post_type', $type)->latest()->get();
        }

        if ($paginate) {

            return Post::latest()->where('post_type', $type)->limit($limit)->paginate($page_count);
        }

        return Post::latest()->where('post_type', $type)->limit($limit)->get();
    }
}
