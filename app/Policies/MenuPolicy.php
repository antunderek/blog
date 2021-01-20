<?php

namespace App\Policies;

use App\User;
use App\Menu;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any menus.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        return $user->role->create_menu || $user->role->edit_menu || $user->role->delete_menu;
    }

    /**
     * Determine whether the user can view the menu.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        //
        return $user->role->create_menu || $user->role->edit_menu || $user->role->delete_menu;
    }

    /**
     * Determine whether the user can create menus.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->role->create_menu;
    }

    /**
     * Determine whether the user can update the menu.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        //
        return $user->role->edit_menu;
    }

    /**
     * Determine whether the user can delete the menu.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        //
        return $user->role->delete_menu;
    }

    /**
     * Determine whether the user can restore the menu.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the menu.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
        return $user->role->delete_menu;
    }
}
