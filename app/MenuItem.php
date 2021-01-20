<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    //
    public function items()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }
}
