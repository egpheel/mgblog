<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;

class AssignRoleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      User::created(function ($user) {
        $user->assignRole('reader');
      });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
