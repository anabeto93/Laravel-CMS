<?php

namespace App\Repositories\Gallery;


interface GalleryContract 
{
    public function all($latest=false, $paginate=false, $page_count=25);

    public function create(array $details);

    public function createMany(array $images);
}

