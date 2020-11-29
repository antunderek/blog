<?php

namespace App\Http\Helpers;

use App\Role;
use App\Article;
use Illuminate\Support\Facades\Auth;

class PermissionHandler
{
    public static function articleOwner(Article $article)
    {
        return $article->user_id === Auth::user()->id;
    }

    public static function isWriter()
    {
        return Role::where('id', Auth::user()->role_id)->get('writer');
    }

    public static function canEditArticles()
    {
        return Role::where('id', Auth::user()->role_id)->get('edit_article');
    }

    public static function canDeleteArticles()
    {
        return Role::where('id', Auth::user()->role_id)->get('delete_article');
    }

    public static function canEditUsers()
    {
        return Role::where('id', Auth::user()->role_id)->get('edit_user');
    }

    public static function canDeleteUsers()
    {
        return Role::where('id', Auth::user()->role_id)->get('delete_user');
    }

    // Abort functions
    public static function notArticleOwnerAbort(Article $article)
    {
        if (!self::articleOwner($article))
        {
            return abort(404);
        }
    }

    public static function notWriterAbort()
    {
        if (!self::isWriter())
        {
            return abort(404);
        }
    }

    public static function notEditArticlesAbort()
    {
        if (!self::canEditArticles())
        {
            return abort(404);
        }
    }

    public static function notDeleteArticlesAbort()
    {
        if (!self::canDeleteArticles())
        {
            return abort(404);
        }
    }

    public static function notEditUsersAbort()
    {
        if (!self::canEditUsers())
        {
            return abort(404);
        }
    }

    public static function notDeleteUsersAbort()
    {
        if (!self::canDeleteUsers())
        {
            return abort(404);
        }
    }
}
