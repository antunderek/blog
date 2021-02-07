<?php

namespace App\Observers;

use App\DefaultRole;
use App\Http\Helpers\RoleCreator;
use App\Role;
use App\User;

class RoleObserver
{
    /**
     * Handle the role "created" event.
     *
     * @param  \App\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        //
    }

    /**
     * Handle the role "updated" event.
     *
     * @param  \App\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        //
        if (!Role::where('role', 'superuser')->first())
        {
            RoleCreator::SuperuserRole();
            session()->flash('info', 'superuser role created.');
        }

        if (!Role::where('role', 'default_user')->first())
        {
            RoleCreator::DefaultUserRole();
            session()->flash('info', 'default_user role created.');
        }
    }

    /**
     * Handle the role "deleted" event.
     *
     * @param  \App\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        //
        session()->flash('success', 'Role successfully deleted.');
        if (!Role::where('role', 'superuser')->first())
        {
            RoleCreator::SuperuserRole();
            session()->forget('success');
            session()->flash('warning', 'Superuser role has to exists, superuser role recreated.');
        }

        if (!Role::where('role', 'default_user')->first())
        {
            RoleCreator::DefaultUserRole();
            session()->forget('success');
            session()->flash('warning', 'Default_role role has to exists, default_role role recreated.');
        }

        $defaultRole = DefaultRole::get();
        if ($defaultRole->isEmpty())
        {
            $defaultRole = new DefaultRole();
            $defaultRole->role_id = Role::where('role', 'default_user')->pluck('id')[0];
            $defaultRole->save();
            session()->flash('info', 'Default role set to default_user');
        }
        else
        {
            $defaultRole = DefaultRole::first();
        }

        User::where('role_id', null)->update(['role_id' => $defaultRole->role_id]);
    }

    /**
     * Handle the role "restored" event.
     *
     * @param  \App\Role  $role
     * @return void
     */
    public function restored(Role $role)
    {
        //
    }

    /**
     * Handle the role "force deleted" event.
     *
     * @param  \App\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        //
    }
}
