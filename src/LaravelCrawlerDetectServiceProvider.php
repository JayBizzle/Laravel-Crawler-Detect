<?php

namespace Jaybizzle\LaravelCrawlerDetect;

use Illuminate\Support\ServiceProvider;

class LaravelCrawlerDetectServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //$this->package('Jaybizzle/LaravelCrawlerDetect');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('LaravelCrawlerDetect', function ($app) {
            return new \Jaybizzle\CrawlerDetect\CrawlerDetect();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
