<?php

namespace App\Services;

use App\Repositories\Contracts\IAuthRepository;
use App\Services\Contracts\IFollowService;
use Illuminate\Support\Facades\Auth;

class FollowService implements IFollowService
{
  public function __construct(
    protected IAuthRepository $authRepo
  ) {}

  public function follow(int $userId)
  {
    $user = $this->authRepo->getUserById($userId);

    /** @var \App\Models\User $currentUser */
    $currentUser = Auth::user();

    if ($currentUser->id === $user->id) {
      return ['message' => 'You cannot follow yourself', 'status_code' => 400];
    }

    if ($currentUser->isFollowing($user)) {
      return ['message' => 'You are already following this user', 'status_code' => 400];
    }

    $currentUser->following()->attach($user);

    return ['message' => 'You are now following ' . $user->name, 'status_code' => 200];
  }

  public function unfollow(int $userId)
  {
    $user = $this->authRepo->getUserById($userId);

    /** @var \App\Models\User $currentUser */
    $currentUser = Auth::user();

    if ($currentUser->id === $user->id) {
      return ['message' => 'You cannot unfollow yourself', 'status_code' => 400];
    }

    if (!$currentUser->isFollowing($user)) {
      return ['message' => 'You are not following this user', 'status_code' => 400];
    }

    $currentUser->following()->detach($user);

    return ['message' => 'You have unfollowed ' . $user->name, 'status_code' => 200];
  }

  public function getFollowers()
  {
    $followers = Auth::user()->followers;
    return $followers ?? [];
  }

  public function getFollowing()
  {
    $following = Auth::user()->following;
    return $following ?? [];
  }
}
