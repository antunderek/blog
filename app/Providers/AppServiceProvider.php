<?php

namespace App\Providers;

use App\Observers\RoleObserver;
use App\Observers\UserObserver;
use App\Role;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        User::observe(UserObserver::class);
        Role::observe(RoleObserver::class);
    }
}
