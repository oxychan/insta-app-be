<?php

namespace App\Services\Contracts;

interface IS3StorageService
{
  public function upload($file, string $filePath, string $fileName);
  public function delete(string $filePath);
  public function getFileUrl(string $filePath);
}
