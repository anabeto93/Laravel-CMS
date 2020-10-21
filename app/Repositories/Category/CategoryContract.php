<?php

namespace App\Repositories\Category;


interface CategoryContract
{
    public function publishedCategories();

    public function findBySlug(string $slug);

    public function all($limit=null);

    public function latest($limit=null);

    public function create(array $properties);
}
