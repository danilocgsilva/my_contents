<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Domain\Interfaces\MetaDataRepositoryInterace;
use Infrastructure\Repositories\MetaDataRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MetaDataRepositoryInterace::class, MetaDataRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
