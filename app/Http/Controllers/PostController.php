<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Services\Contracts\IPostService;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    public function __construct(protected IPostService $postService) {}

    public function createPost(CreatePostRequest $request)
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $imagesStr = [];

                foreach ($images as $image) {
                    $imagesStr[] = $image->get();
                }

                $validated['images'] = $imagesStr;
            }

            $post = $this->postService->createPost($validated);

            return $this->successResponse($post, 'Post created successfully', 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function getPosts()
    {
        try {
            $posts = $this->postService->getPosts();

            return $this->successResponse($posts, 'Posts retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function getPostById(int $id)
    {
        try {
            $post = $this->postService->getPostById($id);

            return $this->successResponse($post, 'Post retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function getCurrentUserPosts()
    {
        try {
            $posts = $this->postService->getCurrentUserPosts();

            return $this->successResponse($posts, 'Posts retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function updatePost(Request $request, int $id)
    {
        try {
            $data = $request->all();
            $post = $this->postService->updatePost($id, $data);

            return $this->successResponse($post, 'Post updated successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function deletePost(int $id)
    {
        try {
            $this->postService->deletePost($id);

            return $this->successResponse([], 'Post deleted successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }
}
