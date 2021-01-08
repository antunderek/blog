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
}
