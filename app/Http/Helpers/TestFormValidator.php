<?php

namespace App\Http\Helpers;

class TestFormValidator extends Validator
{
    public $rules = [
        'user' => [
            'password' => 'required|string|min:8|confirmed',
        ],
        'article' => [
            'title' => 'required|string|max:255',
            'image' => 'max:10000|mimes:jpeg,jpg,png,gif',
        ],
        'comment' => [
            'article' => 'required|integer',
            'comment' => 'required|string|max:255',
            'parent' => 'integer',
        ],
        'update_comment' => [
            'comment' => 'required|string|max:255',
        ],
    ];
}
