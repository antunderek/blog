<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Helpers\Validator;
use App\Http\Traits\ArticleGalleryTrait;
use App\Http\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    use ArticleGalleryTrait;
    use SearchTrait;

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Gallery::class, 'gallery');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('viewAny', Gallery::class);
        $images = Gallery::paginate(30);
        return view('gallery.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Validator::validate($request, 'gallery');

        $image = new Gallery();
        $this->storeParameters($request, $image);
        return redirect()->route('panel.gallery')->with(['success' => 'Image uploaded']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
        return view('gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
        return view('gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
        Validator::validate($request, 'gallery');

        Storage::delete($gallery->image_path);
        $this->storeParameters($request, $gallery);

        return redirect()->route('panel.gallery');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
        Storage::delete($gallery->image_path);
        $gallery->delete();

        return redirect()->route('panel.gallery');
    }

    public function searchGallery(Request $request)
    {
        $this->authorize('viewAny', Gallery::class);
        $columns = ['id', 'image_path'];
        $query = Gallery::select();
        $images = $this->search($query, $columns, $request->keyword, true, 30);
        return view('gallery.index', compact('images'));
    }
}
