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
}
