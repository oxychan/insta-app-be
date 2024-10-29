<?php

namespace App\Services\Contracts;

interface ILikeService
{
  public function likePost(int $postId);
  public function unlikePost(int $postId);
  public function getLikes(int $postId);
  public function isPostLikedByUser(int $postId);
}
