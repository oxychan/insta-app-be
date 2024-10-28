<?php

namespace App\Services\Contracts;

interface IPostService
{
public function createPost(array $post);
  public function getPostById(int $id);
  public function getPosts();
  public function getCurrentUserPosts();
  public function updatePost(int $id, array $data);
  public function deletePost(int $id);
}
