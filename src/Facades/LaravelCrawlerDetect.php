<?php

namespace Jaybizzle\LaravelCrawlerDetect\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelCrawlerDetect extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'LaravelCrawlerDetect';
    }
}
