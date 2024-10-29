<?php

namespace App\Repositories;

use App\Models\Like;
use App\Models\User;
use App\Repositories\Contracts\ILikeRepository;
use Illuminate\Support\Facades\Auth;

class LikeRepository implements ILikeRepository
{
  public function __construct(protected Like $like) {}

  public function likePost(User $user, int $postId)
  {
    return $this->like->create([
      'post_id' => $postId,
      'user_id' => $user->id,
    ]);
  }

  public function unlikePost(User $user, int $postId)
  {
    return $this->like
      ->where('post_id', $postId)
      ->where('user_id', $user->id)
      ->delete();
  }

  public function getLikes(int $postId)
  {
    return $this->like
      ->where('post_id', $postId)
      ->count();
  }

  public function isPostLikedByUser(User $user, int $postId)
  {
    return $this->like
      ->where('post_id', $postId)
      ->where('user_id', $user->id)
      ->count();
  }
}
