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
        // User
        'user_name' => [
            'name' => 'required|string|max:255',
        ],
        'user_password' => [
            'password' => 'required|string|min:8|confirmed',
        ],
        'user_email' => [
            'email' => 'required|string|email|unique:users|max:255',
        ],
        'user_avatar' => [
            'image' => 'required|max:10000|mimes:jpeg,jpg,png,gif',
        ],
        'user_role' => [
            'role' => 'required|integer',
        ],


        // Article
        'article' => [
            'title' => 'required|string|max:255',
            'image' => 'max:10000|mimes:jpeg,jpg,png,gif',
        ],


        // Comment
        'comment' => [
            'article' => 'required|integer',
            'comment' => 'required|string|max:255',
            'parent' => 'integer',
        ],

        'comment_update' => [
            'comment' => 'required|string|max:255',
        ],


        // Role
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

            'edit_comment' => 'required|integer|min:0|max:1',
            'delete_comment' => 'required|integer|min:0|max:1',

            'create_media' => 'required|integer|min:0|max:1',
            'edit_media' => 'required|integer|min:0|max:1',
            'delete_media' => 'required|integer|min:0|max:1',

            'create_menu' => 'required|integer|min:0|max:1',
            'edit_menu' => 'required|integer|min:0|max:1',
            'delete_menu' => 'required|integer|min:0|max:1',
        ],


        // DefaultRole
        'default_role' => [
            'role' => 'required|integer',
        ],


        // Gallery
        'gallery' => [
            'image' => 'required|max:10000|mimes:jpeg,jpg,png,gif',
        ],


        // Avatar
        'avatar' => [
            'image' => 'required|max:10000|mimes:jpeg,jpg,png,gif',
            'default' => 'integer|max:1'
        ],

        'avatar_update' => [
            'image' => 'max:10000|mimes:jpeg,jpg,png,gif',
            'default' => 'integer|max:1'
        ],


        // Menu
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
