<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Contracts\ICommentService;
use App\Http\Requests\CreateCommentRequest;

class CommentController extends BaseController
{
    public function __construct(protected ICommentService $commentService) {}

    public function createComment(CreateCommentRequest $request)
    {
        try {
            $validated = $request->validated();

            $comment = $this->commentService->createComment($validated);

            return $this->successResponse($comment, 'Comment created successfully', 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function getComments(int $postId)
    {
        try {
            $comments = $this->commentService->getComments($postId);

            return $this->successResponse($comments, 'Comments retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function getCommentById(int $id)
    {
        try {
            $comment = $this->commentService->getCommentById($id);

            return $this->successResponse($comment, 'Comment retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function deleteComment(int $id)
    {
        try {
            $comment = $this->commentService->deleteComment($id);

            return $this->successResponse($comment, 'Comment deleted successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function replyComment(int $id, CreateCommentRequest $request)
    {
        try {
            $validated = $request->validated();

            $comment = $this->commentService->replyComment($id, $validated);

            return $this->successResponse($comment, 'Comment replied successfully', 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }
}
