<?php

namespace App\Http\Traits;

use App\Gallery;
use App\Http\Helpers\FileHandler;
use Illuminate\Http\Request;

trait ArticleGalleryTrait
{
    public function storeParameters(Request $request, Gallery $image)
    {
        $image->image_path = $request->file('image')->store('public/images');
        $image->size = FileHandler::imageSize($request->file('image'));
        $image->resolution = FileHandler::imageResolution($request->file('image'));
        $image->save();
        return $image;
    }
}
