<?php

namespace App\Http\Helpers;

use App\User;

class UserCreator
{
    public static function CreateDefaultUser()
    {
        $defaultUser = new User();
    }

    public static function CreateSuperuser()
    {
        $superuser = new User();
    }
}
