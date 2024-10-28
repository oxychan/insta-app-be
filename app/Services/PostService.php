<?php

namespace App\Services;

use App\Repositories\Contracts\IPostRepository;
use App\Services\Contracts\IS3StorageService;
use App\Services\Contracts\IPostService;
use Aws\Proton\ProtonClient;
use Illuminate\Support\Facades\Auth;

class PostService implements IPostService
{
  public function __construct(
    protected IPostRepository $postRepository,
    protected IS3StorageService $storageService
  ) {}

  public function createPost(array $post)
  {
    $imgs = [];
    foreach ($post['images'] as $image) {
      $fileName = time() . '_' . uniqid() . '.png';
      $filePath = 'posts/';
      $uploadedUrl = $this->storageService->upload($image, $filePath, $fileName);
      $imgs[] = $uploadedUrl;
    }

    $user = Auth::user();
    $post['img_urls'] = $imgs;
    $post['user_id'] = $user->id;
    return $this->postRepository->createPost($post);
  }

  public function getPostById(int $id)
  {
    return $this->postRepository->getPostById($id);
  }

  public function getPosts()
  {
    return $this->postRepository->getPosts();
  }

  public function getCurrentUserPosts()
  {
    $user = Auth::user();
    return $this->postRepository->getCurrentUserPosts($user);
  }

  public function updatePost(int $id, array $data)
  {
    return $this->postRepository->updatePost($id, $data);
  }

  public function deletePost(int $id)
  {
    return $this->postRepository->deletePost($id);
  }
}
