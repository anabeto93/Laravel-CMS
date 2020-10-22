<?php

namespace App\Repositories\Post;


interface PostContract
{
    public function publishedPosts();

    public function findBySlug(string $slug, string $type='post');

    public function getCategoryPosts($category);

    public function all($type='post', $limit=null, $paginate=false, $page_count=25);

    public function latest($type='post', $limit=null, $paginate=false, $page_count=25);

    public function create(array $properties);

    public function find(int $id);

    public function update(int $id, array $properties);

    public function delete(int $id);
}
