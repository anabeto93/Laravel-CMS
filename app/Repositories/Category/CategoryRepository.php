<?php

namespace App\Repositories\Category;


use App\Models\Category;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Auth;

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

    public function create(array $properties) 
    {
        $properties = array_merge($properties, ['user_id' => Auth::id(), ]);

        $category = Category::create($properties);

        return $category;
    }

    public function update(int $id, array $properties) 
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->create($properties);
        }

        $category->update($properties);

        return $category->fresh();
    }


    public function delete($id) 
    {
        $category = Category::find($id);

        $category->delete();
    }

    public function find(int $id) 
    {
        return Category::find($id);
    }
}
