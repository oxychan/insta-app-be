<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Contracts\ILikeService;

class LikeController extends BaseController
{
    public function __construct(protected ILikeService $likeService) {}

    public function likePost(int $postId)
    {
        try {
            $like = $this->likeService->likePost($postId);

            return $this->successResponse($like, 'Post liked successfully', 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Post not found', 404);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function unlikePost(int $postId)
    {
        try {
            $like = $this->likeService->unlikePost($postId);

            return $this->successResponse($like, 'Post unliked successfully', 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Post not found', 404);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function getLikes(int $postId)
    {
        try {
            $likes = $this->likeService->getLikes($postId);

            return $this->successResponse($likes, 'Likes retrieved successfully', 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('Post not found', 404);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }
}
