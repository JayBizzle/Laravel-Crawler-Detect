# Laravel Crawler Detect

[![Tests](https://img.shields.io/github/actions/workflow/status/JayBizzle/Laravel-Crawler-Detect/tests.yml?branch=master&style=flat-square&label=tests)](https://github.com/JayBizzle/Laravel-Crawler-Detect/actions/workflows/tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/JayBizzle/Laravel-Crawler-Detect.svg?style=flat-square)](https://packagist.org/packages/jaybizzle/laravel-crawler-detect)
[![Latest Version](https://img.shields.io/packagist/v/JayBizzle/Laravel-Crawler-Detect.svg?style=flat-square)](https://packagist.org/packages/jaybizzle/laravel-crawler-detect)
[![License](https://img.shields.io/packagist/l/JayBizzle/Laravel-Crawler-Detect.svg?style=flat-square)](LICENSE)

A Laravel wrapper for [Crawler-Detect](https://github.com/JayBizzle/Crawler-Detect) - the web crawler detection library.

## Requirements

- PHP 8.1+
- Laravel 10, 11, 12 or 13

Need support for an older version of Laravel or PHP? Use [v1.3.0](https://github.com/JayBizzle/Laravel-Crawler-Detect/tree/v1.3.0) of this package.

## Installation

```bash
composer require jaybizzle/laravel-crawler-detect
```

The service provider and the `Crawler` facade alias are registered automatically via package auto-discovery.

## Usage

```php
use Crawler;

// Check the current visitor's user agent
if (Crawler::isCrawler()) {
    // true if a crawler user agent was detected
}

// Or pass a user agent string to check
if (Crawler::isCrawler('Mozilla/5.0 (compatible; aiHitBot/2.9; +https://www.aihitdata.com/about)')) {
    // true if a crawler user agent was detected
}

// Output the name of the bot that matched (if any)
echo Crawler::getMatches();
```

You can also type-hint the underlying class and let the container inject it:

```php
use Jaybizzle\CrawlerDetect\CrawlerDetect;

public function index(CrawlerDetect $crawlerDetect)
{
    if ($crawlerDetect->isCrawler()) {
        // ...
    }
}
```

Or use the `Request` macros, which detect using the current request:

```php
use Illuminate\Http\Request;

public function index(Request $request)
{
    if ($request->isCrawler()) {
        // Output the name of the bot that matched (if any)
        echo $request->crawler()->getMatches();
    }

    // Or pass a user agent string to check
    if ($request->isCrawler('Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)')) {
        // ...
    }
}
```

## Testing

```bash
composer test
```

## License

Laravel Crawler Detect is open-sourced software licensed under the [MIT license](LICENSE).
