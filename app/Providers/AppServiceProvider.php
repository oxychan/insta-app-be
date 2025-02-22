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

        $this->app->bind(
            'App\Repositories\Contracts\IPostRepository',
            'App\Repositories\PostRepository'
        );

        $this->app->bind(
            'App\Services\Contracts\IPostService',
            'App\Services\PostService'
        );

        $this->app->bind(
            'App\Services\Contracts\IS3StorageService',
            'App\Services\S3StorageService'
        );

        $this->app->bind(
            'App\Repositories\Contracts\ILikeRepository',
            'App\Repositories\LikeRepository'
        );

        $this->app->bind(
            'App\Services\Contracts\ILikeService',
            'App\Services\LikeService'
        );

        $this->app->bind(
            'App\Repositories\Contracts\ICommentRepository',
            'App\Repositories\CommentRepository'
        );

        $this->app->bind(
            'App\Services\Contracts\ICommentService',
            'App\Services\CommentService'
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
