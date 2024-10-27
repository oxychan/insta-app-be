<?php

namespace App\Services\Contracts;

interface IUserProfileService
{
  public function createProfile(array $data);
  public function getProfileByUserId(int $id);
  public function updateProfile(array $data);
  public function deleteProfile();
  public function getUserProfile();
}
