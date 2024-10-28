<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface IPostRepository
{
  public function createPost(array $post);
  public function getPostById(int $id);
  public function getPosts();
  public function getCurrentUserPosts(User $user);
  public function updatePost(int $id, array $data);
  public function deletePost(int $id);
}
