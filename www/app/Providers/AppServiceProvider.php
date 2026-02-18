<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Domain\Interfaces\MetaDataRepositoryInterace;
use Infrastructure\Repositories\MetaDataRepository;
use Domain\Interfaces\ContentRepositoryInterface;
use Infrastructure\Repositories\ContentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MetaDataRepositoryInterace::class, MetaDataRepository::class);
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
