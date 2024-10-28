<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Contracts\IFollowService;
use App\Http\Resources\FollowResource;
use App\Http\Resources\UserResource;

class FollowController extends BaseController
{
    public function __construct(protected IFollowService $followService) {}

    public function followUser(int $id)
    {
        try {
            $follow = $this->followService->follow($id);

            return $this->successResponse($follow['data'], $follow['message'], $follow['status_code']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('User not found', 404);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function unfollowUser(int $id)
    {
        try {
            $follow = $this->followService->unfollow($id);

            return $this->successResponse($follow['data'], $follow['message'], $follow['status_code']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('User not found', 404);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function getFollowers()
    {
        try {
            $followers = $this->followService->getFollowers();

            return $this->successResponse($followers, 'Followers retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function getFollowings()
    {
        try {
            $followings = $this->followService->getFollowing();

            return $this->successResponse($followings, 'Followings retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }
}
