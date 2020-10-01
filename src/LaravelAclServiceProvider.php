<?php
namespace Ribafs\LaravelAcl;

use Illuminate\Support\ServiceProvider;

class LaravelAclServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-acl.php', 'laravel-acl');

        // Register the service the package provides.
        $this->app->singleton('laravel-acl', function ($app) {
            return new LaravelAcl;
        });
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

        // Publishing provider.
        $this->publishes([
            __DIR__.'/../acl/PermissionsServiceProvider.php' => app_path('Providers/PermissionsServiceProvider.php'),
        ], 'laravel-acl.provider');

        // Publishing Middleware.
        $this->publishes([
            __DIR__.'/../acl/RoleMiddleware.php' => app_path('Http/Middleware/RoleMiddleware.php'),
        ], 'laravel-acl.middleware');

        // Publishing routes.
        $this->publishes([
            __DIR__.'/../acl/web.php' => base_path('routes/web.php'),
        ], 'laravel-acl.web');

        // Publishing command.
        $this->publishes([
            __DIR__.'/../src/Commands/CopyFilesCommand.php' => app_path('Console/Commands/CopyFilesCommand.php'),
        ], 'laravel-acl.web');

        // Registering package commands.
        //$this->commands($this->commands);
    }
}
