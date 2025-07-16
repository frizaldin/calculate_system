<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\AuthServiceInterface;
use App\Services\CategoryService;
use App\Services\CategoryServiceInterface;
use App\Services\WishlistService;
use App\Services\WishlistServiceInterface;
use App\Services\ProjectServiceInterface;
use App\Services\ProjectService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Services\UploadService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(WishlistServiceInterface::class, WishlistService::class);
        $this->app->bind(ProjectServiceInterface::class, ProjectService::class);
        $this->app->singleton(UploadService::class, function ($app) {
            return new UploadService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::middleware('web')
            ->group(base_path('routes/tasklist.php'));

        Route::middleware('web')
            ->group(base_path('routes/wishlist.php'));
    }
}
