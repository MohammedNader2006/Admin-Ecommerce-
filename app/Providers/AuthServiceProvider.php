<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('isAdmin', function ($admin) {
            
            return $admin->name == 'admin';
        });
        Gate::define('isMo', function ($admin) {
            return $admin->name == 'mohamed';
        });

    }
}
