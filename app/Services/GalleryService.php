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

    /**
     * @param string|int $id
     */
    public function find($id) 
    {
        return $this->gallery->find((int) $id);
    }

    /**
     * @param string|int $id
     */
    public function delete($id): void
    {
        $this->gallery->delete($id);

        Session::flash('message', 'Image successfully deleted.');
    }

    /**
     * @param string|int $id
     * @param Request $request
     */
    public function update($id, Request $request)
    {
        $images = $request->image_url;

        $data = [];

        foreach($images as $i => $image_url) {
            $original_file = $image_url->getClientOriginalName();

            $file_name = strtolower(implode('_', explode(' ', trim(pathinfo($original_file, PATHINFO_FILENAME)))));

            $file_ext = $image_url->getClientOriginalExtension();

            $fn = $file_name . '.' . $file_ext;

            //don't waste db records updating something that has not changed,
            $data['image_url'] = $fn;

            if ($i == 0) {//only the first one matters
            break;
            }
        }

        $saved = $this->gallery->update((int) $id, $data);

        if ($saved) {

            $image_url->storeAs('public/galleries', $saved->image_url);
        }

        Session::flash('message', 'Image updated successfully.');

        return  $saved;
    }
}