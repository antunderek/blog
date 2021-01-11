<?php

namespace App\Policies;

use App\User;
use App\DefaultRole;
use Illuminate\Auth\Access\HandlesAuthorization;

class DefaultRolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the default role.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        //
        return $user->role->edit_role;
    }
}
