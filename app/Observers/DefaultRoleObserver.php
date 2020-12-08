<?php

namespace App\Observers;

use App\DefaultRole;
use App\Http\Helpers\RoleCreator;
use App\Role;

class DefaultRoleObserver
{
    /**
     * Handle the default role "created" event.
     *
     * @param  \App\DefaultRole  $defaultRole
     * @return void
     */
    public function created(DefaultRole $defaultRole)
    {
        //
        if (!$defaultRole->role_id)
        {
<<<<<<< HEAD
            $role = new Role();
            $role->role = "default_user";
            $role->writer = false;
            $role->edit_article = false;
            $role->delete_article = false;

            $role->create_role = false;
            $role->edit_role = false;
            $role->delete_role = false;

            $role->create_user = false;
            $role->edit_user = false;
            $role->delete_user = false;

            $role->save();

=======
            $role = RoleCreator::DefaultUserRole();
>>>>>>> master
            $defaultRole->role_id = $role->id;
            $defaultRole->save();
        }
    }

    /**
     * Handle the default role "updated" event.
     *
     * @param  \App\DefaultRole  $defaultRole
     * @return void
     */
    public function updated(DefaultRole $defaultRole)
    {
        //
        if (!$defaultRole->role_id)
        {
            $role = new Role();
            $role->role = "default_user" . rand(0, 1000);
            $role->writer = false;
            $role->edit_article = false;
            $role->delete_article = false;

            $role->create_role = false;
            $role->edit_role = false;
            $role->delete_role = false;

            $role->create_user = false;
            $role->edit_user = false;
            $role->delete_user = false;

            $role->save();

            $defaultRole->role_id = $role->id;
            $defaultRole->save();
        }
    }

    /**
     * Handle the default role "deleted" event.
     *
     * @param  \App\DefaultRole  $defaultRole
     * @return void
     */
    public function deleted(DefaultRole $defaultRole)
    {
        //
    }

    /**
     * Handle the default role "restored" event.
     *
     * @param  \App\DefaultRole  $defaultRole
     * @return void
     */
    public function restored(DefaultRole $defaultRole)
    {
        //
    }

    /**
     * Handle the default role "force deleted" event.
     *
     * @param  \App\DefaultRole  $defaultRole
     * @return void
     */
    public function forceDeleted(DefaultRole $defaultRole)
    {
        //
    }
}