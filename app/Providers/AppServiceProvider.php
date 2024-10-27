<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Services\Contracts\IAuthService',
            'App\Services\AuthService'
        );

        $this->app->bind(
            'App\Repositories\Contracts\IAuthRepository',
            'App\Repositories\AuthRepository'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
