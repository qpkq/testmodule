<?php

namespace AdminDatabaseProvider\Providers;

use AdminDatabaseProvider\Http\Middleware\AdminAuthMiddleware;
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
         * Configs.
         */
        $this->publishes([
            __DIR__.'/../config/admin_panel.php' => config_path('admin_panel.php'),
        ], 'config');

        /*
         * Routes.
         */
        $this->loadRoutesFrom(__DIR__ . '/../../routes/admin/admin.php');

        /*
         * Middleware.
         */
        $this->app['router']->aliasMiddleware('admin-panel', AdminAuthMiddleware::class);
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
