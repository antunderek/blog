<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any comments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        return $user->role->edit_comment || $user->role->delete_comment;
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        //
        if (($comment->user_id !== $user->id) && !$user->role->edit_comment)
        {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        //
        return $user->role->delete_comment;
    }
}
