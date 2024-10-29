<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Contracts\ICommentRepository;

class CommentRepository implements ICommentRepository
{
  public function __construct(protected Comment $comment) {}

  public function createComment(array $comment)
  {
    return $this->comment->create($comment);
  }

  public function getCommentById(int $id)
  {
    return $this->comment->find($id);
  }

  public function getComments()
  {
    return $this->comment->all();
  }

  public function updateComment(int $id, array $data)
  {
    return $this->comment->find($id)->update($data);
  }

  public function deleteComment(int $id)
  {
    return $this->comment->find($id)->delete();
  }

  public function replyComment(int $id, array $comment)
  {
    return $this->comment->find($id)->replies()->create($comment);
  }
}
