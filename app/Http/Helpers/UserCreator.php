<?php

namespace App\Http\Helpers;

use App\Role;
use App\User;

class UserCreator
{
    public static function CreateDefaultUser()
    {
        $defaultUser = new User();
        $defaultUser->name = 'default_user';
        $defaultUser->email = 'defaultuser@email.com';
        $defaultUser->role_id = Role::where('role', 'default_user');
        $defaultUser->save();
    }

    public static function CreateSuperuser()
    {
        $superuser = new User();
        $superuser->name = 'superuser';
        $superuser->email = 'superuser@email.com';
        $superuser->role_id = Role::where('role', 'superuser');
        $superuser->save();
    }
}
