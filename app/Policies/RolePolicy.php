<?php

namespace App\Policies;

use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any roles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        return $user->role->create_role || $user->role->edit_role || $user->role->delete_role;
    }

    /**
     * Determine whether the user can view the role.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        //
        return $user->role->create_role || $user->role->edit_role || $user->role->delete_role;
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->role->create_role;
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        //
        return $user->role->edit_role;
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        //
        return $user->role->delete_role;
    }

    /**
     * Determine whether the user can restore the role.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the role.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
        return $user->role->delete_role;
    }
}
