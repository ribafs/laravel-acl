<?php
namespace Ribafs\LaravelAcl;

use Illuminate\Support\ServiceProvider;

class LaravelAclServiceProvider extends ServiceProvider
{    
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //$this->commands();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-acl'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravel-acl.php' => config_path('laravel-acl.php'),
        ], 'laravel-acl.config');

        // Directories
        // Publishing the migrations.
        $this->publishes([
            __DIR__.'/../acl/migrations/' => base_path('database/migrations/'),
        ], 'laravel-acl.nigrations');

        // Publishing seeders.
        $this->publishes([
            __DIR__.'/../acl/seeders/' => base_path('database/seeders/'),
        ], 'laravel-acl.seeders');

        // Publishing Models.
        $this->publishes([
            __DIR__.'/../acl/Models/' => app_path('Models'),
        ], 'laravel-acl.models');

        // Publishing the controllers.
        $this->publishes([
            __DIR__.'/../acl/Controllers/' => app_path('Http/Controllers/'),
        ], 'laravel-acl.controllers');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../acl/views/' => base_path('resources/views/'),
        ], 'laravel-acl.viewss');

        // Publishing commands.
        $this->publishes([
            __DIR__.'/../acl/Commands/' => app_path('Console/Commands/'),
        ], 'laravel-acl.commands');

        // Files
        // Publishing provider.
        $this->publishes([
            __DIR__.'/../acl/PermissionsServiceProvider.php' => app_path('Providers/PermissionsServiceProvider.php'),
        ], 'laravel-acl.provider');

        // Publishing Middleware.
        $this->publishes([
            __DIR__.'/../acl/RoleMiddleware.php' => app_path('Http/Middleware/RoleMiddleware.php'),
        ], 'laravel-acl.middleware');

        // Publishing trait.
        $this->publishes([
            __DIR__.'/../acl/HasPermissionsTrait.php' => app_path('Traits/HasPermissionsTrait.php'),
        ], 'laravel-acl.middleware');
    
        // Registering package commands.
        //$this->commands([]);
    }
}
