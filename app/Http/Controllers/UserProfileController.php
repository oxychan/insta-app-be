<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Http\Resources\UserProfileResource;
use App\Services\Contracts\IUserProfileService;

class UserProfileController extends BaseController
{
    public function __construct(protected IUserProfileService $profileService) {}

    public function createProfile(UserProfileRequest $request)
    {
        try {
            $validated = $request->validated();
            $profile = $this->profileService->createProfile($validated);

            return $this->successResponse(new UserProfileResource($profile), 'Profile created successfully', 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function getProfileByUserId(int $id)
    {
        try {
            $profile = $this->profileService->getProfileByUserId($id);

            return $this->successResponse(new UserProfileResource($profile), 'Profile retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function updateProfile(UserProfileRequest $request)
    {
        try {
            $validated = $request->validated();
            $profile = $this->profileService->updateProfile($validated);

            return $this->successResponse(new UserProfileResource($profile), 'Profile updated successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function deleteProfile()
    {
        try {
            $profile = $this->profileService->deleteProfile();

            return $this->successResponse($profile, 'Profile deleted successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    public function getUserProfile()
    {
        try {
            $profile = $this->profileService->getUserProfile();

            return $this->successResponse(new UserProfileResource($profile), 'Profile retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }
}
