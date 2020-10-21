<?php

namespace App\Repositories\Post;


interface PostContract
{
    public function publishedPosts();

    public function findBySlug(string $slug);

    public function getCategoryPosts($category);

    public function all($type='post', $limit=null, $paginate=false, $page_count=25);

    public function latest($type='post', $limit=null, $paginate=false, $page_count=25);
}
