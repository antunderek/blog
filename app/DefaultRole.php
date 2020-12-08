<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultRole extends Model
{
    //
    public function role()
    {
        return $this->hasOne('App\Models\Role');
    }
}
