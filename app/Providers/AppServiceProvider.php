<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Repositories\Interfaces\UserRepositoryInterface::class,\App\Repositories\Implements\UserRepository::class);
        $this->app->singleton(\App\Repositories\Interfaces\BlogRepositoryInterface::class,\App\Repositories\Implements\BlogRepository::class);
        $this->app->singleton(\App\Repositories\Interfaces\CategoryRepositoryInterface::class,\App\Repositories\Implements\CategoryRepository::class);
        $this->app->singleton(\App\Repositories\Interfaces\RoleRepositoryInterface::class,\App\Repositories\Implements\RoleRepository::class);
        $this->app->singleton(\App\Repositories\Interfaces\PermissionRepositoryInterface::class,\App\Repositories\Implements\PermissionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
