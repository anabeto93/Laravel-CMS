<?php

namespace App\Repositories\Gallery;

use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryRepository implements GalleryContract 
{

    public function all($latest=false, $paginate=false, $page_count=25) 
    {
        if ($latest) {
            if ($paginate) {
                $galleries = Gallery::latest()->paginate($page_count);
            } else {
                $galleries = Gallery::latest()->get();
            }
        } else {
            if ($paginate) {
                $galleries = Gallery::paginate($page_count);
            } else {
                $galleries = Gallery::all();
            }
        }

        return $galleries;
    }


    public function create(array $details)
    {
        return Gallery::create($details);
    }

    public function createMany(array $images)
    {
        $id = Auth::id();

        foreach($images as $i => $image) {
            $images[$i]['user_id'] = $id;
        }

        $galleries = Gallery::insert($images);

        if ($galleries) {

            $urls = collect($images)->pluck('image_url')->toArray();

            return Gallery::whereIn('image_url', $urls)->latest()->limit(count($urls))->get();
        }

        return $galleries;
    }

    public function find(int $id) 
    {
        return Gallery::find($id);
    }

    public function update(int $id, array $details) 
    {
        $gallery = $this->find($id);

        if (!$gallery) {
            $details['user_id'] = Auth::id();

            $gallery = Gallery::create($details);
        } else {
            $gallery->update($details);
        }

        if ($gallery instanceof Gallery) {
            return $gallery->fresh();
        }

        return $gallery;
    }

    public function delete(int $id): void
    {
        $gallery = $this->find($id);

        if ($gallery instanceof Gallery) {
            $link = $gallery->image_url;

             //also delete it from storage
            Storage::delete('public/galleries/' . $link);
            
            $gallery->delete();
        }
    }
}