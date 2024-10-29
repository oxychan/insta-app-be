<?php

namespace App\Repositories\Contracts;

use App\Models\Post;
use App\Models\User;

interface ILikeRepository
{
  public function likePost(User $user, int $postId);
  public function unlikePost(User $user, int $postId);
  public function getLikes(int $postId);
  public function isPostLikedByUser(User $user, int $postId);
}
