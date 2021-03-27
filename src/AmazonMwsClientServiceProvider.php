<?php

namespace EolabsIo\AmazonMwsClient;

use Illuminate\Support\ServiceProvider;
use EolabsIo\AmazonMwsClient\AmazonMwsHttp;
use EolabsIo\AmazonMwsClient\AmazonMwsClient;
use EolabsIo\AmazonMwsClient\Support\UrlSigner;

class AmazonMwsClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            if (AmazonMwsClient::$runsMigrations) {
                $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
            }

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations/amazonMwsClient'),
            ], 'amazon-mws-client-migrations');

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('amazon-mws-client.php'),
            ], 'amazon-mws-client-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('amazon-mws-http', function () {
            return new AmazonMwsHttp;
        });

        $this->app->singleton('url-signer', function () {
            return new UrlSigner;
        });
    }
}
