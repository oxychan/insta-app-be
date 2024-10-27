<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Services\Contracts\IAuthService;

class AuthController extends BaseController
{
    public function __construct(protected IAuthService $authService) {}

    public function register(RegisterRequest $request)
    {
        try {
            $validated = $request->validated();
            $user = $this->authService->register($validated);

            return $this->successResponse(new UserResource($user), 'User registered successfully', 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $validated = $request->validated();
            $user = $this->authService->login($validated);

            if (!$user) {
                return $this->errorResponse('Invalid credentials', 401);
            }

            return $this->successResponse(new LoginResource($user), 'User logged in successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function logout()
    {
        try {
            $this->authService->logout();

            return $this->successResponse([], 'User loged out successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }
}
