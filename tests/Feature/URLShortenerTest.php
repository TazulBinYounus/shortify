<?php

namespace Tests\Feature;

use App\Models\ShortURL;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class URLShortenerTest extends TestCase
{
  use RefreshDatabase;

  public function test_generate_short_url()
  {
    $response = $this->postJson('/shorten', ['original_url' => 'https://example.com']);

    $response->assertStatus(200)
      ->assertJsonStructure(['short_url']);
  }

  public function test_redirect_to_original_url()
  {
    ShortURL::create([
      'original_url' => 'https://example.com',
      'short_code' => 'VjWky',
    ]);

    $response = $this->get('/VjWky');
    $response->assertRedirect('https://example.com');
  }

  public function test_redirect_to_invalid_url()
  {
    $response = $this->get('/invalid');
    $response->assertStatus(404);
  }
}
