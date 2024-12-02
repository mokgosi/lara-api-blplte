<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\PostRepositoryInterface;
use App\Repositories\PostRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class,PostRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
