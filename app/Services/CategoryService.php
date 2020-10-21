<?php

namespace App\Services;


use App\Repositories\Category\CategoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryService
{
    /** @var CategoryContract */
    private $category;

    public function __construct(CategoryContract $categoryContract)
    {
        $this->category = $categoryContract;
    }

    public function getPublishedCategories()
    {
        return $this->category->publishedCategories();
    }

    /**
     * @param string|int $id
     */
    public function find($id)
    {
        return $this->category->find((int) $id);
    }

    public function findBySlug(string $slug)
    {
        if (!$slug) return null;

        return $this->category->findBySlug($slug);
    }

    public function all($latest=false, $limit=null)
    {
        if (!$latest) {
            return $this->category->all($limit);
        }

        return $this->category->latest($limit);
    }

    public function create(Request $request)
    {
        $data = $request->only('thumbnail', 'name', 'is_published', 'slug');

        if (!array_key_exists('slug', $data)) {
            $data['slug'] = str_slug($data['name']);
        }
        
        Session::flash('message', 'Category successfully created.');

        return $this->category->create($data);
    }

    public function update($id, Request $request)
    {
        $data = $request->only('thumbnail', 'name', 'is_published', 'slug');

        if (!array_key_exists('slug', $data)) {
            $data['slug'] = str_slug($data['name']);
        }
        
        Session::flash('message', 'Category updated.');

        return $this->category->update((int) $id, $data);
    }

    /**
     * @param string|int $id
     */
    public function delete($id) : void
    {
        $this->category->delete($id);

        Session::flash('message', 'Category deleted.');
    }
}
