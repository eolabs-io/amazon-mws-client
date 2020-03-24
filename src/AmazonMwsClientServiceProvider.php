<?php

namespace EolabsIo\AmazonMwsClient;

use EolabsIo\AmazonMwsClient\AmazonMwsHttp;
use EolabsIo\AmazonMwsClient\Support\UrlSigner;
use Illuminate\Support\ServiceProvider;

class AmazonMwsClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'amazon-mws-client');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'amazon-mws-client');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('amazon-mws-client.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/amazon-mws-client'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/amazon-mws-client'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/amazon-mws-client'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'amazon-mws-client');

        // Register the main class to use with the facade
        $this->app->singleton('amazon-mws-http', function () {
            return new AmazonMwsHttp;
        });

        $this->app->singleton('url-signer', function () {
            return new UrlSigner;
        });
    }
}
