<?php

namespace App\Observers;

use App\Avatar;
use App\DefaultRole;
use App\Http\Helpers\UserCreator;
use App\Role;
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
        // Ako user nema postavljeni role_id, automatski staviti role_id iz tablice DefaultRole
        if (!$user->role_id)
        {
            $user->role_id = DefaultRole::first()->pluck('role_id')[0];
        }

        $user->image_id = Avatar::where('default', true)->first()->pluck('id')[0];
        $user->save();
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        // Isto kao i createad(), provjera da li postoji superuser, ako ne stvoriti novog
        $superuserRoleId = Role::where('role', 'superuser')->pluck('id')[0];
        $superuserUser = User::where('email', 'superuser@email.com')->get()->first();
        if ($superuserUser->role_id !== $superuserRoleId) {
            $superuserUser->role_id = $superuserRoleId;
            $superuserUser->save();
        }

        if (!$user->role_id)
        {
            $user->role_id = DefaultRole::first()->pluck('role_id')[0];
            $user->save();
        }
        if (User::where('role_id', $superuserRoleId)->count() === 0)
        {
            UserCreator::CreateSuperuser();
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
        // Provjera da li postoji superuser, ako ne stvoriti novog
        $superuserRoleId = Role::where('role', 'superuser')->pluck('id')[0];

        if ($user->role_id === $superuserRoleId)
        {
            if (User::where('role_id', $superuserRoleId)->count() === 0)
            {
                UserCreator::CreateSuperuser();
            }
        }

        if ($user->image !== null)
        {
            if(!$user->image->default)
            {
                $user->image->delete();
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
