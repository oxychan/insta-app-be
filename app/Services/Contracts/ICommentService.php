<?php

namespace App\Services\Contracts;

interface ICommentService
{
  public function createComment(array $comment);
  public function getCommentById(int $id);
  public function getComments();
  public function updateComment(int $id, array $data);
  public function deleteComment(int $id);
  public function replyComment(int $id, array $comment);
}
