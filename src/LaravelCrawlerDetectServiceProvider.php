<?php

namespace Jaybizzle\LaravelCrawlerDetect;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

class LaravelCrawlerDetectServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CrawlerDetect::class, function (Application $app) {
            return new CrawlerDetect($app['request']->server());
        });

        $this->app->alias(CrawlerDetect::class, 'LaravelCrawlerDetect');
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Request::macro('crawler', function () {
            // Scoped to the request rather than resolved from the container, so
            // that mutating it can't leak into the shared singleton, and so two
            // requests in the same lifecycle can't overwrite each other.
            if (! $this->attributes->has('jaybizzle.crawler-detect')) {
                $this->attributes->set('jaybizzle.crawler-detect', new CrawlerDetect($this->server->all()));
            }

            return $this->attributes->get('jaybizzle.crawler-detect');
        });

        Request::macro('isCrawler', function (?string $userAgent = null) {
            return $this->crawler()->isCrawler($userAgent);
        });
    }
}
