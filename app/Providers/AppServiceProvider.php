<?php

namespace App\Providers;

use App\Interfaces\URLShortenerRepositoryInterface;
use App\Repositories\URLShortenerRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(URLShortenerRepositoryInterface::class, URLShortenerRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
