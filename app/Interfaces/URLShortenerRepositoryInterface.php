<?php

namespace App\Interfaces;

interface URLShortenerRepositoryInterface
{
  public function create(array $data): object;
  public function findByShortCode(string $shortCode): ?object;
}
