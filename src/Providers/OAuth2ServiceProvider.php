<?php

namespace LantosBro\OAuth2\Providers;

use Illuminate\Support\ServiceProvider;

class OAuth2ServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
              __DIR__ . '/../../database/migrations' => database_path('migrations/'),
            ], 'integration-migrations');

            $this->publishes([
                __DIR__.'/../../config/oauth2.php' => config_path('oauth2.php'),
            ], 'integration-config');
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('oauth2', 'LantosBro\OAuth2\Package');

        // Register the main class to use with the facade
        $this->app->bind('oauth2.connection', 'LantosBro\OAuth2\Contracts\Connection');

        $this->app->bind('LantosBro\OAuth2\Contracts\Connection', 'LantosBro\OAuth2\Connection');
    }
}
