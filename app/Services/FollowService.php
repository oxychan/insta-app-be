<?php

namespace App\Services;

use App\Http\Resources\FollowResource;
use App\Http\Resources\UserResource;
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
      throw new \Exception('You cannot follow yourself', 400);
    }

    if ($currentUser->isFollowing($user)) {
      throw new \Exception('You are already following this user', 400);
    }

    $currentUser->following()->attach($user);

    return new FollowResource(['message' => 'You are now following ' . $user->name, 'status_code' => 200, 'data' => new UserResource($user)]);
  }

  public function unfollow(int $userId)
  {
    $user = $this->authRepo->getUserById($userId);

    /** @var \App\Models\User $currentUser */
    $currentUser = Auth::user();

    if ($currentUser->id === $user->id) {
      throw new \Exception('You cannot unfollow yourself', 400);
    }

    if (!$currentUser->isFollowing($user)) {
      throw new \Exception('You are not following this user', 400);
    }

    $currentUser->following()->detach($user);

    return new FollowResource(['message' => 'You have unfollowed ' . $user->name, 'status_code' => 200, 'data' => new UserResource($user)]);
  }

  public function getFollowers()
  {
    $followers = UserResource::collection(Auth::user()->followers);
    return $followers ?? [];
  }

  public function getFollowing()
  {
    $following = UserResource::collection(Auth::user()->following);
    return $following ?? [];
  }
}
