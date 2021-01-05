<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    //
    public function name()
    {
        $exploded = explode('/', $this->attributes['image_path']);
        return end($exploded);
    }
}
