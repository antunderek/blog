<?php

namespace App\Http\Helpers;

use App\Role;

class RoleCreator
{
    public static function DefaultUserRole()
    {
        $role = new Role();
        $role->role = "default_user";
        $role->writer = false;
        $role->edit_article = false;
        $role->delete_article = false;

        $role->create_role = false;
        $role->edit_role = false;
        $role->delete_role = false;

        $role->create_user = false;
        $role->edit_user = false;
        $role->delete_user = false;

        $role->edit_comment = false;
        $role->delete_comment = false;

        $role->create_media = false;
        $role->edit_media = false;
        $role->delete_media = false;

        $role->create_menu = false;
        $role->edit_menu = false;
        $role->delete_menu = false;

        $role->save();
        return $role;
    }

    public static function SuperuserRole()
    {
        $role = new Role();
        $role->role = 'superuser';
        $role->writer = true;
        $role->edit_article = true;
        $role->delete_article = true;

        $role->create_role = true;
        $role->edit_role = true;
        $role->delete_role = true;

        $role->create_user = true;
        $role->edit_user = true;
        $role->delete_user = true;

        $role->edit_comment = true;
        $role->delete_comment = true;

        $role->create_media = true;
        $role->edit_media = true;
        $role->delete_media = true;

        $role->create_menu = true;
        $role->edit_menu = true;
        $role->delete_menu = true;

        $role->save();
        return $role;
    }
}
