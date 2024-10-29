<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use App\Repositories\Contracts\IPostRepository;

class PostRepository implements IPostRepository
{
  public function __construct(protected Post $post) {}

  public function createPost(array $post)
  {
    return $this->post->create($post);
  }

  public function getPostById(int $id)
  {
    return $this->post->findOrFail($id);
  }

  public function getPosts()
  {
    return $this->post->all();
  }

  public function getCurrentUserPosts(User $user)
  {
    return $this->post->where('user_id', $user->id)->get();
  }

  public function updatePost(int $id, array $data)
  {
    return $this->post->where('id', $id)->update($data);
  }

  public function deletePost(int $id)
  {
    return $this->post->destroy($id);
  }
}
