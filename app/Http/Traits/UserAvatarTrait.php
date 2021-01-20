<?php

namespace App\Http\Traits;

use App\Avatar;
use App\Http\Helpers\FileHandler;
use Illuminate\Http\Request;

trait UserAvatarTrait
{
    public function setPathResolutionSizeAvatar(Request $request, Avatar $avatar)
    {
        $avatar->image_path = $request->file('image')->store('public/avatars');
        $avatar->size = FileHandler::imageSize($request->file('image'));
        $avatar->resolution = FileHandler::imageResolution($request->file('image'));
        return $avatar;
    }
}
