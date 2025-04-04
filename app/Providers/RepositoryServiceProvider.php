<?php

namespace App\Providers;

use App\Models\Composition;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ButeurRepository\ButeurRepository;
use App\Repositories\ButeurRepository\ButeurRepositoryInterface;
use App\Repositories\CompositionRepository\CompositionRepository;
use App\Repositories\CompositionRepository\CompositionRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ButeurRepositoryInterface::class, ButeurRepository::class);
        $this->app->bind(CompositionRepositoryInterface::class, CompositionRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
