<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Services\AuthService;

class AuthController extends BaseController
{
    public function __construct(protected AuthService $authService) {}

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
            $user = $this->authService->login($request->validated());

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
