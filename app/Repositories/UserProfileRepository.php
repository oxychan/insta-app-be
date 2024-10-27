<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserProfile;
use App\Repositories\Contracts\IUserProfileRepository;

class UserProfileRepository implements IUserProfileRepository
{
  public function __construct(protected UserProfile $profile, protected User $user) {}

  public function createProfile(array $data)
  {
    return $this->profile->create($data);
  }

  public function getProfileByUserId(int $id)
  {
    return $this->profile->where('user_id', $id)->first();
  }
}
