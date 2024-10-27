<?php

namespace App\Services\Contracts;

interface IFollowService
{
  public function follow(int $userId);
  public function unfollow(int $userId);
  public function getFollowers();
  public function getFollowing();
}
