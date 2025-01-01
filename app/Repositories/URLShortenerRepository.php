<?php

namespace App\Repositories;

use App\Interfaces\URLShortenerRepositoryInterface;
use App\Models\ShortURL;

class URLShortenerRepository implements URLShortenerRepositoryInterface
{
  public function create(array $data): object
  {
    return ShortURL::create($data);
  }

  public function findByShortCode(string $shortCode): ?object
  {
    return ShortURL::where('short_code', $shortCode)->first();
  }
}
