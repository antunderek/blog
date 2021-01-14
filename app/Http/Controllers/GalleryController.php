<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Helpers\FileHandler;
use App\Http\Helpers\PermissionHandler;
use App\Http\Helpers\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
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
        //PermissionHandler::noMediaEditorAbort();
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
        //PermissionHandler::notCreateMediaAbort();
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
        //PermissionHandler::notCreateMediaAbort();
        Validator::validate($request, 'gallery');

        $image = new Gallery();
        $image->image_path = $request->file('image')->store('public/images');
        $image->size = FileHandler::imageSize($request->file('image'));
        $image->resolution = FileHandler::imageResolution($request->file('image'));
        $image->save();

        return redirect()->route('panel.gallery');
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
        //PermissionHandler::noMediaEditorAbort();
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
        //PermissionHandler::notEditMediaAbort();
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
        //PermissionHandler::notEditMediaAbort();
        Validator::validate($request, 'gallery');

        Storage::delete($gallery->image_path);
        $gallery->image_path = $request->file('image')->store('public/images');
        $gallery->size = FileHandler::imageSize($request->file('image'));
        $gallery->resolution = FileHandler::imageResolution($request->file('image'));
        $gallery->save();

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
        //PermissionHandler::notDeleteMediaAbort();
        Storage::delete($gallery->image_path);
        $gallery->delete();

        return redirect()->route('panel.gallery');
    }
}
