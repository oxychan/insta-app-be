<?php

namespace App\Services;

use App\Services\Contracts\IS3StorageService;
use Illuminate\Support\Facades\Storage;

class S3StorageService implements IS3StorageService
{
  protected $disk;

  public function __construct()
  {
    $this->disk = Storage::disk('s3');
  }
  public function upload($file, string $filePath, string $fileName)
  {
    $up = $this->disk->put($filePath . $fileName, $file);
    return self::getFileUrl($filePath . $fileName);
  }

  public function delete(string $filePath)
  {
    return $this->disk->delete($filePath);
  }

  public function getFileUrl(string $filePath)
  {
    return Storage::url($filePath);
  }
}
