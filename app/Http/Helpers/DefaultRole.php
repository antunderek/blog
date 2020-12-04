<?php

namespace App\Http\Helpers;

// Default role for newly registered users
use App\Role;

class DefaultRole
{
    public static function defaultRole()
    {}

    private function defaultIsSet()
    {
        // Provjeri u tablici da li je default set
    }

    private function createDefaultRole()
    {
        $defaultRole = new Role();
        $defaultRole->title = 'default user';

        $defaultRole->writer = false;
        $defaultRole->edit_article = false;
        $defaultRole->delete_article = false;

        $defaultRole->create_role = false;
        $defaultRole->edit_role = false;
        $defaultRole->delete_role = false;

        $defaultRole->create_user = false;
        $defaultRole->edit_user = false;
        $defaultRole->delete_user = false;

        $defaultRole->save();
    }

    private function setDefault(Role $role)
    {
        // U tablici default role
    }
}
