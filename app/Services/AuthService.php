<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\IAuthService;
use App\Repositories\AuthRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class AuthService implements IAuthService
{
  public function __construct(protected AuthRepository $authRepository) {}

  public function register(array $data)
  {
    return $this->authRepository->createUser($data);
  }

  public function login(array $credentials)
  {
    if (!Auth::attempt($credentials)) {
      return null;
    }

    /** @var \App\Models\User $user */
    $user = Auth::user();
    $user['token'] = $user->createToken('authToken')->plainTextToken;

    return $user;
  }

  public function logout()
  {
    /** @var \App\Models\User $user */
    $user = Auth::user();
    $user->tokens()->delete();
  }

  public function user(): ?Authenticatable
  {
    return Auth::user();
  }

  public function getUserById(int $id)
  {
    return $this->authRepository->getUserById($id);
  }

  public function updateUser(int $id, array $data)
  {
    return $this->authRepository->updateUser($id, $data);
  }

  public function deleteUser(int $id)
  {
    return $this->authRepository->deleteUser($id);
  }

  public function getUserByEmail(string $email)
  {
    return $this->authRepository->getUserByEmail($email);
  }
}
