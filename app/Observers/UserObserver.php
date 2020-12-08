<?php

namespace App\Observers;

use App\DefaultRole;
use App\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
        if (!$user->role_id)
        {
            $defaultRole = DefaultRole::first();
            if (empty($defaultRole))
            {
                $defaultRole = new DefaultRole();
                $defaultRole->save();
                $user->role_id = $defaultRole->role_id;
            }
            else
            {
                $user->role_id = DefaultRole::first()->pluck('role_id')[0];
            }
            $user->save();
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
        if (!$user->role_id)
        {
            $defaultRole = DefaultRole::first();
            if (empty($defaultRole))
            {
                $defaultRole = new DefaultRole();
                $defaultRole->save();
                $user->role_id = $defaultRole->role_id;
            }
            else
            {
                $user->role_id = DefaultRole::first()->pluck('role_id')[0];
            }
            $user->save();
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
        if ($user->role === 'superuser')
        {
            if (User::where('role', 'superuser')->count() === 0)
            {
                // Create new superuser
            }
        }
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
