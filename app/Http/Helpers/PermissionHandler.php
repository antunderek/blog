<?php

namespace App\Http\Helpers;

use App\Role;
use App\Article;
use Illuminate\Support\Facades\Auth;

class PermissionHandler
{
    // Article functions
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

    public static function isArticleEditor()
    {
        if (self::canDestroyArticles() || self::canEditArticles())
        {
            return true;
        }
    }

    // Role functions
    public static function canCreateRoles()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('create_role')->first();
    }

    public static function canEditRoles()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('edit_role')->first();
    }

    public static function canDeleteRoles()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('delete_role')->first();
    }

    public static function isRoleEditor()
    {
        if (self::canCreateRoles() || self::canEditRoles() || self::canDeleteRoles())
        {
            return true;
        }
    }


    // User functions
    public static function canCreateUsers()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('create_user')->first();
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
        if (self::canCreateUsers() || self::canEditUsers() || self::canDeleteUsers())
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


    // Roles
    public static function notCreateRolesAbort()
    {
        if (!self::canCreateRoles())
        {
            return abort(404);
        }
    }

    public static function notEditRolesAbort()
    {
        if (!self::canEditRoles())
        {
            return abort(404);
        }
    }

    public static function notDeleteRolesAbort()
    {
        if (!self::canDeleteRoles())
        {
            return abort(404);
        }
    }

    public static function noRoleEditorAbort()
    {
        if (!self::isRoleEditor())
        {
            return abort(404);
        }
    }


    // Users
    public static function notCreateUsersAbort()
    {
        if (!self::canCreateUsers())
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
