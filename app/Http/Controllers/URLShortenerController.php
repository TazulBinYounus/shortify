<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortUrlRequest;
use App\Services\URLShortenerService;

class URLShortenerController extends Controller
{
  protected $service;

  public function __construct(URLShortenerService $service)
  {
    $this->service = $service;
  }

  public function create(ShortUrlRequest $request)
  {
    try {
      // Generate the short code for the URL
      $shortCode = $this->service->generateShortCode($request->original_url);

      // Return the shortened URL as a response
      return response()->json([
        'short_url_action' => url($shortCode),
        'short_url' => $shortCode,
      ]);
    } catch (\Exception $e) {
      // Handle any errors that may occur during the process
      return response()->json([
        'errors' => ['Something went wrong. Please try again later.'],
      ], 500);
    }
  }

  public function redirect($shortURL)
  {
    $originalUrl = $this->service->getOriginalURL($shortURL);

    if (!$originalUrl) {
      abort(404, 'Short URL not found.');
    }

    return redirect()->to($originalUrl);
  }
}
