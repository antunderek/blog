<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'menu_id')->whereNull('parent_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menus_roles', 'menu_id', 'role_id');
    }
}
