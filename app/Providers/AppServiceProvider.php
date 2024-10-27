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

        $this->app->bind(
            'App\Repositories\Contracts\IUserRepository',
            'App\Repositories\UserRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\IUserProfileRepository',
            'App\Repositories\UserProfileRepository'
        );

        $this->app->bind(
            'App\Services\Contracts\IUserProfileService',
            'App\Services\UserProfileService'
        );

        $this->app->bind(
            'App\Services\Contracts\IUserService',
            'App\Services\UserService'
        );

        $this->app->bind(
            'App\Services\Contracts\IFollowService',
            'App\Services\FollowService'
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
