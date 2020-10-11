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
        // Here only folders with new files and only copy without overwrite
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravel-acl.php' => config_path('laravel-acl.php'),
        ], 'laravel-acl.config');

        // Directories
        // Publishing the migrations.
        $this->publishes([
            __DIR__.'/../up/database/' => base_path('/database'),
        ], 'laravel-acl.database');

        // Publishing app.
        $this->publishes([
            __DIR__.'/../up/app/' => base_path('/app'),
        ], 'laravel-acl.models');

        // Publishing the resources.
        $this->publishes([
            __DIR__.'/../up/resources/' => base_path('/resources'),
        ], 'laravel-acl.viewss');

        // Publishing commands.
        $this->publishes([
            __DIR__.'/../up/Commands/' => app_path('Console/Commands'),
        ], 'laravel-acl.commands');
  
        // Registering package commands.
        //$this->commands([]);
    }
}
