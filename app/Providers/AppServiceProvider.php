<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

use App\Models\ProductVariant;
use App\Policies\ProductVariantPolicy;

use App\Repositories\UserRepositroy;
use App\Repositories\PaymentRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductVariantRepository;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\PaymentRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ProductVariantRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductVariantRepositoryInterface::class, ProductVariantRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepositroy::class);
    }

    public function boot(): void
    {
        Route::aliasMiddleware('admin', AdminMiddleware::class);
        Gate::define('is-user', function ($user) {
            return $user->role === 'user';
        });
    }
}
