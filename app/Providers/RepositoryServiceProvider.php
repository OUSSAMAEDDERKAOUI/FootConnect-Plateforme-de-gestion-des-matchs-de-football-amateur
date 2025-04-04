<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ButeurRepository\ButeurRepositoryInterface;
use App\Repositories\ButeurRepository\ButeurRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ButeurRepositoryInterface::class, ButeurRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
