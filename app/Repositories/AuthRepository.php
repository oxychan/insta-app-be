<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\IAuthRepository;

class AuthRepository implements IAuthRepository
{
  public function __construct(protected User $user) {}

  public function createUser(array $data)
  {
    return $this->user->create($data);
  }

  public function getUserByEmail(string $email)
  {
    return $this->user->where('email', $email)->first();
  }

  public function getUserById(int $id)
  {
    return $this->user->findOrFail($id);
  }

  public function updateUser(int $id, array $data)
  {
    return $this->user->findOrfail($id)->update($data);
  }

  public function deleteUser(int $id)
  {
    return $this->user->findOrfail($id)->delete();
  }
}
