<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Gallery' => 'App\Policies\GalleryPolicy',
        'App\Avatar' => 'App\Policies\AvatarPolicy',

        'App\Menu' => 'App\Policies\MenuPolicy',
        'App\MenuItem' => 'App\Policies\MenuPolicy',

        'App\Role' => 'App\Policies\RolePolicy',
        'App\DefaultRole' => 'App\Policies\DefaultRolePolicy',

        'App\Comment' => 'App\Policies\CommentPolicy',

        'App\User' => 'App\Policies\UserPolicy',

        'App\Article' => 'App\Policies\ArticlePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
