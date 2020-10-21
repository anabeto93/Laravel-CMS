<?php

namespace App\Repositories\Category;


interface CategoryContract
{
    public function publishedCategories();

    public function findBySlug(string $slug);

    public function all($limit=null);

    public function latest($limit=null);

    public function create(array $properties);

    public function delete($id);

    public function find(int $id);

    public function update(int $id, array $properties);
}
