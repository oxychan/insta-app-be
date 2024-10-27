<?php

namespace App\Repositories\Contracts;

interface IUserProfileRepository
{
  public function createProfile(array $data);
  public function getProfileByUserId(int $id);
}
