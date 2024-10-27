<?php

namespace App\Services\Contracts;

interface IAuthService
{
  public function register(array $data);
  public function login(array $credentials);
  public function logout();
  public function user();
}
