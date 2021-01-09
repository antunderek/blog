<?php

namespace App\Http\Helpers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory as IlluminateValidator;

abstract class Validator {

    public static function validate(Request $data, string $rules, array $custom_errors = array()) {
        $validation = $data->validate(self::$rules[$rules], $custom_errors);
    }

    public static $rules = [
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

        'comment_update' => [
            'comment' => 'required|string|max:255',
        ],

        'role' => [
            'role' => 'required|string|max:255',
            'edit_article' => 'required|integer|min:0|max:1',
            'delete_article' => 'required|integer|min:0|max:1',
            'create_role' => 'required|integer|min:0|max:1',
            'edit_role' => 'required|integer|min:0|max:1',
            'delete_role' => 'required|integer|min:0|max:1',
            'create_user' => 'required|integer|min:0|max:1',
            'edit_user' => 'required|integer|min:0|max:1',
            'delete_user' => 'required|integer|min:0|max:1',
        ],

        'default_role' => [
            'role' => 'required|integer',
        ],

        'gallery' => [
            'image' => 'required|max:10000|mimes:jpeg,jpg,png,gif',
        ],

        'avatar' => [
            'image' => 'required|max:10000|mimes:jpeg,jpg,png,gif',
            'default' => 'integer|max:1'
        ],

        'avatar_update' => [
            'image' => 'max:10000|mimes:jpeg,jpg,png,gif',
            'default' => 'integer|max:1'
        ],

        'menu' => [
            'title' => 'required|string|max:255',
            'order' => 'required|integer|min:0'
        ],

        'menu_update' => [
            'title' => 'string|max:255',
            'order' => 'integer|min:0'
        ],

        'menu_item' => [
            'menu_id' => 'required|integer|min:0',
            'parent_id' => 'integer|min:0',
            'item' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ],

        'menu_item_update' => [
            'item' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ],
    ];
}
