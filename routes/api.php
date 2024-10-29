<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::prefix('profile')->group(function () {
        Route::controller(UserProfileController::class)->group(function () {
            Route::get('/', 'getUserProfile');
            Route::get('/{id}', 'getProfileByUserId');
            Route::post('/create', 'createProfile');
            Route::put('/', 'updateProfile');
            Route::delete('/', 'deleteProfile');
        });
    });

    Route::prefix('user')->group(function () {
        Route::controller(FollowController::class)->group(function () {
            Route::get('/followers', 'getFollowers');
            Route::get('/followings', 'getFollowings');
            Route::post('/follow/{id}', 'followUser');
            Route::post('/unfollow/{id}', 'unfollowUser');
        });
    });

    Route::prefix('posts')->group(function () {
        Route::controller(PostController::class)->group(function () {
            Route::get('/', 'getPosts');
            Route::get('/user', 'getCurrentUserPosts');
            Route::get('/{id}', 'getPostById');
            Route::post('/create', 'createPost');
            Route::put('/{id}', 'updatePost');
            Route::delete('/{id}', 'deletePost');
        });

        Route::controller(LikeController::class)->group(function () {
            Route::post('/like/{id}', 'likePost');
            Route::post('/unlike/{id}', 'unlikePost');
            Route::get('/likes/{id}', 'getLikes');
        });
    });
});
