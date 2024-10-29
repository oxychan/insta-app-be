<?php

namespace App\Services;

use App\Repositories\Contracts\ILikeRepository;
use App\Repositories\Contracts\IPostRepository;
use App\Services\Contracts\ILikeService;
use Illuminate\Support\Facades\Auth;

class LikeService implements ILikeService
{
  public function __construct(
    protected ILikeRepository $likeRepo,
    protected IPostRepository $postRepo
  ) {}

  public function likePost(int $postId)
  {
    $user = Auth::user();

    $post = $this->postRepo->getPostById($postId);

    if (self::isPostLikedByUser($post->id) > 0) {
      throw new \Exception('Post already liked', 400);
    }

    return $this->likeRepo->likePost($user, $postId);
  }

  public function unlikePost(int $postId)
  {
    $user = Auth::user();

    $post = $this->postRepo->getPostById($postId);

    if (self::isPostLikedByUser($post->id) < 1) {
      throw new \Exception('Post not liked', 400);
    }

    return $this->likeRepo->unlikePost($user, $postId);
  }

  public function getLikes(int $postId)
  {
    $post = $this->postRepo->getPostById($postId);
    return $this->likeRepo->getLikes($post->id);
  }

  public function isPostLikedByUser(int $postId)
  {
    $user = Auth::user();
    return $this->likeRepo->isPostLikedByUser($user, $postId);
  }
}
