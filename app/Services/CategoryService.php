<?php

namespace App\Services;


use App\Repositories\Category\CategoryContract;

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
}
