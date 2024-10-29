<?php

namespace App\Services;

use App\Models\Comment;
use App\Repositories\Contracts\ICommentRepository;
use App\Services\Contracts\ICommentService;
use Illuminate\Support\Facades\Auth;

class CommentService implements ICommentService
{
  public function __construct(protected ICommentRepository $commentRepository) {}

  public function createComment(array $comment)
  {
    $user = Auth::user();
    $comment['user_id'] = $user->id;
    return $this->commentRepository->createComment($comment);
  }

  public function getCommentById(int $id)
  {
    return $this->commentRepository->getCommentById($id);
  }

  public function getComments()
  {
    return $this->commentRepository->getComments();
  }

  public function updateComment(int $id, array $data)
  {
    return $this->commentRepository->updateComment($id, $data);
  }

  public function deleteComment(int $id)
  {
    return $this->commentRepository->deleteComment($id);
  }

  public function replyComment(int $id, array $comment)
  {
    return $this->commentRepository->replyComment($id, $comment);
  }
}
