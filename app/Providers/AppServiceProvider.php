<?php

declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\ICategoryRepository;
use App\Interfaces\IProductRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(IProductRepository::class, ProductRepository::class);
        $this->app->singleton(ICategoryRepository::class, CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
