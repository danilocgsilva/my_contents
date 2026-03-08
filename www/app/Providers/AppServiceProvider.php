<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Domain\Interfaces\MetaDataRepositoryInterace;
use Infrastructure\Repositories\MetaDataRepository;
use Domain\Interfaces\ContentRepositoryInterface;
use Infrastructure\Repositories\ContentRepository;
use Domain\Interfaces\ContentInterface;
use Domain\Content;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MetaDataRepositoryInterace::class, MetaDataRepository::class);
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
        $this->app->bind(ContentInterface::class, Content::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
