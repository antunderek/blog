<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'roles';

    public function user()
    {
        $this->hasMany(User::class);
    }

    public function default() {
        return $this->belongsTo(DefaultRole::class, 'id', 'role_id');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menus_roles', 'role_id', 'menu_id');
    }
}
