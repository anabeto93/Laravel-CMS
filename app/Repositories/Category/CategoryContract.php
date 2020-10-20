<?php

namespace App\Repositories\Category;


interface CategoryContract
{
    public function publishedCategories();

    public function findBySlug(string $slug);
}
