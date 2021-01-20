<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    public function article() {
        $this->belongsTo(Article::class);
    }

    public function name()
    {
        $exploded = explode('/', $this->attributes['image_path']);
        return end($exploded);
    }
}
