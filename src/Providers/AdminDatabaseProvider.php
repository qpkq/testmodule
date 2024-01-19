<?php

namespace Providers;

use Http\Middleware\AdminAuthMiddleware;
use Illuminate\Support\ServiceProvider;

class AdminDatabaseProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot(): void
    {
        /*
         * Routes.
         */
        $this->loadRoutesFrom(__DIR__ . '/../../routes/admin/admin.php');

        /*
         * Middleware.
         */
        $this->app['router']->aliasMiddleware('auth:admin-panel', AdminAuthMiddleware::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
