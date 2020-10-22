<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Repositories\Gallery\GalleryContract;

class GalleryService 
{
    /** @var GalleryContract */
    private $gallery;

    public function __construct(GalleryContract $galleryContract)
    {
        $this->gallery = $galleryContract;
    }

    public function all($latest=false) 
    {
        return $this->gallery->all($latest);
    }

    public function create(Request $request)
    {
        $images = $request->image_url;
        $data = [];
        $to_be_stored = [];

        foreach($images as $image_url) {
            $original_file = $image_url->getClientOriginalName();

            $file_name = strtolower(implode('_', explode(' ', trim(pathinfo($original_file, PATHINFO_FILENAME)))));

            $file_ext = $image_url->getClientOriginalExtension();

            $fn = $file_name . '.' . $file_ext;
            $data[] = ['image_url' => $fn];

            $to_be_stored[] = [
                $fn => $image_url,
            ];
        }

        $galleries = $this->gallery->createMany($data);
        
        if ($galleries) {
            foreach($galleries as $stored_image) {
                foreach($to_be_stored as $payload) {
                    if (is_array($payload) && (array_key_exists($stored_image->image_url, $payload))) {
                    
                        $temp_content = $payload[$stored_image->image_url];
    
                        $temp_content->storeAs('public/galleries', $stored_image->image_url);

                    break;
                    }
                }
            
            }
        }

        Session::flash('message', 'Image(s) uploaded successfully.');

        return $galleries;
    }
}