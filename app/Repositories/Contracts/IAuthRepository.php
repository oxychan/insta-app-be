<?php

namespace App\Repositories\Contracts;

interface IAuthRepository
{
  public function createUser(array $user);
  public function getUserByEmail(string $email);
  public function getUserById(int $id);
  public function updateUser(int $id, array $data);
  public function deleteUser(int $id);
}
