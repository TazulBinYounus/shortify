<?php

namespace App\Services;

use App\Interfaces\URLShortenerRepositoryInterface;
use Illuminate\Support\Str;

class URLShortenerService
{
  protected $repository;

  public function __construct(URLShortenerRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function generateShortCode(string $originalUrl): string
  {
    do {
      // Generate a hash from the original URL (using sha1 for simplicity)
      $hash = sha1($originalUrl);

      // Take the first 8 characters of the hash
      $hashPart = substr($hash, 0, 8);

      // Convert the hash part to a numeric value
      $numericValue = hexdec($hashPart); // Convert the hash to a decimal number

      // Convert the numeric value to Base62
      $shortCode =  $this->toBase62($numericValue);
    } while ($this->repository->findByShortCode($shortCode));

    $this->repository->create([
      'original_url' => $originalUrl,
      'short_code' => $shortCode,
    ]);

    return $shortCode;
  }

  public function getOriginalURL(string $shortCode): ?string
  {
    $shortURL = $this->repository->findByShortCode($shortCode);
    return $shortURL ? $shortURL->original_url : null;
  }

  // Function to convert a number to Base62
  private function toBase62($num)
  {
    $base62 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $base62String = '';

    while ($num > 0) {
      $base62String = $base62[$num % 62] . $base62String;
      $num = floor($num / 62);
    }

    return $base62String;
  }
}
