<?php

namespace App\Http\Helpers;

use App\Avatar;
use App\User;
use Illuminate\Support\Facades\Storage;

class AvatarCreator
{
    public static function defaultAvatar()
    {
        $destinationFile = 'public/avatars/default_avatar.png';
        $defaultAvatar = Avatar::where('image_path', $destinationFile)->get()->first();

        if ($defaultAvatar === null)
        {
            if (!Storage::disk('public')->exists($destinationFile))
            {
                Storage::copy('images/default_avatar.png', $destinationFile);
            }
            $defaultAvatar = new Avatar();
            $defaultAvatar->image_path = $destinationFile;
        }

        $defaultAvatar->default = true;
        $defaultAvatar->save();

        User::where('image_id', null)->update(['image_id' => $defaultAvatar->id]);

        return $defaultAvatar;
    }
}
