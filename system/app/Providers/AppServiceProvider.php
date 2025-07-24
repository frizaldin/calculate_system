<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\Interface\AuthServiceInterface;
use App\Services\CategoryService;
use App\Services\Interface\CategoryServiceInterface;
use App\Services\WishlistService;
use App\Services\Interface\WishlistServiceInterface;
use App\Services\ProjectServiceInterface;
use App\Services\ProjectService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Services\UploadService;
use App\Services\Interface\MonthlyFinanceServiceInterface;
use App\Services\MonthlyFinanceService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Services\Interface\AuthServiceInterface::class, AuthService::class);
        $this->app->bind(\App\Services\Interface\CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(\App\Services\Interface\WishlistServiceInterface::class, WishlistService::class);
        $this->app->bind(\App\Services\Interface\ProjectServiceInterface::class, ProjectService::class);
        $this->app->bind(\App\Services\Interface\MonthlyFinanceServiceInterface::class, MonthlyFinanceService::class);
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

        Route::middleware('web')
            ->group(base_path('routes/monthly_finance.php'));
    }
}
