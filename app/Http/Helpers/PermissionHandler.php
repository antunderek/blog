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
        return Role::where('id', Auth::user()->role_id)->pluck('writer')->first();
    }

    public static function canEditArticles()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('edit_article')->first();
    }

    public static function canDestroyArticles()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('delete_article')->first();
    }

    public static function isEditor()
    {
        if (self::canDestroyArticles() || self::canEditArticles())
        {
            return true;
        }
    }

    public static function canEditUsers()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('edit_user')->first();
    }

    public static function canDeleteUsers()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('delete_user')->first();
    }

    public static function isUserEditor()
    {
        if (self::canEditUsers() || self::canDeleteUsers())
        {
            return true;
        }
    }

    // Abort functions
    // Articles
    public static function notArticleOwnerAbort(Article $article)
    {
        if (!self::articleOwner($article))
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

    public static function notDestroyArticlesAbort()
    {
        if (!self::canDestroyArticles())
        {
            return abort(404);
        }
    }

    public static function noEditingPermissionsAbort(Article $article)
    {
        if (!(self::isWriter() && self::articleOwner($article)))
        {
            self::notEditArticlesAbort();
        }
    }

    public static function noDestroyPermissionsAbort(Article $article)
    {
        if (!(self::isWriter() && self::articleOwner($article)))
        {
            self::notDestroyArticlesAbort();
        }
    }

    public static function notWriterAbort()
    {
        if (!self::isWriter())
        {
            return abort(404);
        }
    }




    // Users
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
