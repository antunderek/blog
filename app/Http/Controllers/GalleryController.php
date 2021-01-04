<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Helpers\PermissionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        PermissionHandler::noGalleryEditorAbort();
        $images = Gallery::all();
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
        PermissionHandler::notCreateGalleryAbort();
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
        PermissionHandler::notCreateGalleryAbort();

        if ($request->file('image')) {
            $image = new Gallery();
            $image->image_path = $request->file('image')->store('public/images');
            $image->save();
        }

        return redirect()->back();
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
        PermissionHandler::notEditGalleryAbort();
        return view('gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $image)
    {
        //
        PermissionHandler::notEditGalleryAbort();
        if ($request->file('image')) {
            $image->image_path = $request->file('image')->store('public/images');
            $image->save();
        }

        return redirect()->back();
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
        PermissionHandler::notDeleteGalleryAbort();
        Storage::delete($gallery->image_path);
        $gallery->delete();

        return redirect()->route('panel.gallery');
    }
}
