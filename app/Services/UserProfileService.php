<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\IUserProfileRepository;
use App\Services\Contracts\IUserProfileService;
use Illuminate\Support\Facades\Auth;

class UserProfileService implements IUserProfileService
{

  public function __construct(protected IUserProfileRepository $profileRepo) {}

  public function createProfile(array $data)
  {
    return $this->profileRepo->createProfile($data);
  }

  public function getProfileByUserId(int $id)
  {
    return $this->profileRepo->getProfileByUserId($id);
  }

  public function updateProfile(array $data)
  {
    $userProfile = Auth::user()->profile;
    return tap($userProfile)->update($data);
  }

  public function deleteProfile()
  {

    return Auth::user()->profile->delete();
  }

  public function getUserProfile()
  {
    return Auth::user()->profile;
  }
}
