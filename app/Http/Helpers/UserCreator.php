<?php

namespace App\Http\Helpers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserCreator
{
    public static function CreateSuperuser()
    {
        $superuser = new User();
        $superuser->name = 'superuser';
        $superuser->email = 'superuser@email.com';
        $superuser->role_id = Role::where('role', 'superuser')->pluck('id')[0];
        $superuser->password = Hash::make('password');
        $superuser->save();
    }
}
