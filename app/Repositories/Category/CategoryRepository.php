<?php

namespace App\Repositories\Category;


use App\Models\Category;
use App\Models\CategoryPost;

class CategoryRepository implements CategoryContract
{
    /**
     * @return mixed
     */
    public function publishedCategories()
    {
        return Category::published()->orderBy('name', 'ASC')->get();
    }

    public function findBySlug(string $slug)
    {
        return Category::published()->where('slug', $slug)->first();
    }

    public function all($limit=null)
    {
        if (!$limit) {
            return Category::all();
        }

        return Category::limit($limit)->get();
    }

    public function latest($limit=null)
    {
        if (!$limit) {
            return Category::latest()->get();
        }
        return Category::latest()->limit($limit)->get();
    }
}
