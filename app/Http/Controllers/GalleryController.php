<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\GalleryService;

class GalleryController extends Controller
{
    /** @var GalleryService */
    private $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $galleries = $this->galleryService->all(true);

        return view('admin.gallery.index')->withGalleries($galleries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image_url' => ['required',],
        ], [
            'image_url.required' => 'Select image.',
        ]);

        $gallery = $this->galleryService->create($request);

        return redirect()->to(route('galleries.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param string|int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string|int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string|int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string|int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
