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


    // Comment functions
    public static function canEditComments()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('edit_comment')->first();
    }

    public static function canDeleteComments()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('delete_comment')->first();
    }

    public static function isCommentEditor()
    {
        if (self::canEditComments() || self::canDeleteComments())
        {
            return true;
        }
    }


    // Media functions
    public static function canCreateMedia()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('create_media')->first();
    }

    public static function canEditMedia()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('edit_media')->first();
    }

    public static function canDeleteMedia()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('delete_media')->first();
    }

    public static function isMediaEditor()
    {
        if (self::canCreateMedia() || self::canEditMedia() || self::canDeleteMedia())
        {
            return true;
        }
    }


    // Menu functions
    public static function canCreateMenus()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('create_menu')->first();
    }

    public static function canEditMenus()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('edit_menu')->first();
    }

    public static function canDeleteMenus()
    {
        return Role::where('id', Auth::user()->role_id)->pluck('delete_menu')->first();
    }

    public static function isMenuEditor()
    {
        if (self::canCreateMenus() || self::canEditMenus() || self::canDeleteMenus())
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


    // Comments
    public static function notEditCommentAbort()
    {
        if (!self::canEditComments())
        {
            return abort(404);
        }
    }

    public static function notDeleteCommentAbort()
    {
        if (!self::canDeleteComments())
        {
            return abort(404);
        }
    }

    public static function noCommentEditorAbort()
    {
        if (!self::isCommentEditor())
        {
            return abort(404);
        }
    }


    // Media
    public static function notCreateMediaAbort()
    {
        if (!self::canCreateMedia())
        {
            return abort(404);
        }
    }

    public static function notEditMediaAbort()
    {
        if (!self::canEditMedia())
        {
            return abort(404);
        }
    }

    public static function notDeleteMediaAbort()
    {
        if (!self::canDeleteMedia())
        {
            return abort(404);
        }
    }

    public static function noMediaEditorAbort()
    {
        if (!self::isMediaEditor())
        {
            return abort(404);
        }
    }


    // Menu
    public static function notCreateMenuAbort()
    {
        if (!self::canCreateMenus())
        {
            return abort(404);
        }
    }

    public static function notEditMenuAbort()
    {
        if (!self::canEditMenus())
        {
            return abort(404);
        }
    }

    public static function notDeleteMenuAbort()
    {
        if (!self::canDeleteMenus())
        {
            return abort(404);
        }
    }

    public static function noMenuEditorAbort()
    {
        if (!self::isMenuEditor())
        {
            return abort(404);
        }
    }
}
