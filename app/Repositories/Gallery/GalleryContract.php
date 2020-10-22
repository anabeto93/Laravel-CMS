<?php

namespace App\Repositories\Gallery;


interface GalleryContract 
{
    public function all($latest=false, $paginate=false, $page_count=25);

    public function create(array $details);

    public function createMany(array $images);

    public function find(int $id);

    public function update(int $id, array $details);

    public function delete(int $id): void;
}

