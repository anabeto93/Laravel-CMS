<?php

namespace App\Repositories\Post;


use Debugbar;
use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Auth;

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

    public function create(array $properties) 
    {
        $properties['user_id'] = Auth::id();

        if (!array_key_exists('post_type', $properties)) {
            $properties['post_type'] = 'post';
        }
        
        $post = Post::create($properties);

        if (array_key_exists('categories', $properties) && is_array(($cats = $properties['categories']))) {
            $id = $post->id;//to reduce accessing it everytime

            foreach($cats as $cat) {
                CategoryPost::create([
                    'post_id' => $id,
                    'category_id' => $cat,
                ]);
            }
        }

        return $post;
    }
}
