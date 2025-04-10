<?php

namespace App\Providers;

use App\Models\Equipe;
use App\Models\Composition;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ButeurRepository\ButeurRepository;
use App\Repositories\EquipeRepository\EquipeRepository;
use App\Repositories\RapportRepository\RapportRepository;
use App\Repositories\BlessureRepository\BlessureRepository;
use App\Repositories\ChangementRepository\ChangementRepository;
use App\Repositories\ButeurRepository\ButeurRepositoryInterface;
use App\Repositories\EquipeRepository\EquipeRepositoryInterface;
use App\Repositories\CompositionRepository\CompositionRepository;
use App\Repositories\RapportRepository\RapportRepositoryInterface;
use App\Repositories\BlessureRepository\BlessureRepositoryInterface;
use App\Repositories\ChangementRepository\ChangementRepositoryInterface;
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
        $this->app->bind(RapportRepositoryInterface::class, RapportRepository::class);
        $this->app->bind(BlessureRepositoryInterface::class, BlessureRepository::class);
        $this->app->bind(ChangementRepositoryInterface::class, ChangementRepository::class);
        $this->app->bind(EquipeRepositoryInterface::class, EquipeRepository::class);


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
