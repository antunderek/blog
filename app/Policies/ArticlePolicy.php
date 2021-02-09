<?php

namespace App\Policies;

use App\User;
use App\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any articles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function view(User $user, Article $article)
    {
        //
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->role->writer;
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
        //
        if (($article->user_id !== $user->id || !$user->role->writer) && !$user->role->edit_article)
        {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function delete(User $user, Article $article)
    {
        //
        if (($article->user_id !== $user->id || !$user->role->writer) && !$user->role->delete_article)
        {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can restore the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function restore(User $user, Article $article)
    {
        //
        if (($article->user_id !== $user->id || !$user->role->writer) && !$user->role->delete_article)
        {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can permanently delete the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function forceDelete(User $user, Article $article)
    {
        //
        if (($article->user_id !== $user->id || !$user->role->writer) && !$user->role->delete_article)
        {
            return false;
        }
        return true;
    }

    /**
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function panelArticles(User $user)
    {
        return $user->role->edit_article || $user->role->delete_article;
    }

    /**
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function panelUserArticles(User $user)
    {
        return $user->role->writer;
    }
}
