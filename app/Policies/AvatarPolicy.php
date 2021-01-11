<?php

namespace App\Policies;

use App\User;
use App\Avatar;
use Illuminate\Auth\Access\HandlesAuthorization;

class AvatarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any avatars.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        return $user->role->create_media || $user->role->edit_media || $user->role->delete_media;
    }

    /**
     * Determine whether the user can view the avatar.
     *
     * @param  \App\User  $user
     * @param  \App\Avatar  $avatar
     * @return mixed
     */
    public function view(User $user, Avatar $avatar)
    {
        //
        return $user->role->create_media || $user->role->edit_media || $user->role->delete_media;
    }

    /**
     * Determine whether the user can create avatars.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->role->create_media;
    }

    /**
     * Determine whether the user can update the avatar.
     *
     * @param  \App\User  $user
     * @param  \App\Avatar  $avatar
     * @return mixed
     */
    public function update(User $user, Avatar $avatar)
    {
        //
        return $user->role->edit_media;
    }

    /**
     * Determine whether the user can delete the avatar.
     *
     * @param  \App\User  $user
     * @param  \App\Avatar  $avatar
     * @return mixed
     */
    public function delete(User $user, Avatar $avatar)
    {
        //
        return $user->role->delete_media;
    }

    /**
     * Determine whether the user can restore the avatar.
     *
     * @param  \App\User  $user
     * @param  \App\Avatar  $avatar
     * @return mixed
     */
    public function restore(User $user, Avatar $avatar)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the avatar.
     *
     * @param  \App\User  $user
     * @param  \App\Avatar  $avatar
     * @return mixed
     */
    public function forceDelete(User $user, Avatar $avatar)
    {
        //
        return $user->role->delete_media;
    }
}
