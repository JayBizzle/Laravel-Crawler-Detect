Laravel Crawler Detect
=======
[![Build Status](https://img.shields.io/travis/JayBizzle/Laravel-Crawler-Detect/master.svg?style=flat-square)](https://travis-ci.org/JayBizzle/Laravel-Crawler-Detect) [![Total Downloads](https://img.shields.io/packagist/dt/JayBizzle/Laravel-Crawler-Detect.svg?style=flat-square)](https://packagist.org/packages/jaybizzle/laravel-crawler-detect)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/JayBizzle/Laravel-Crawler-Detect.svg?style=flat-square)](https://scrutinizer-ci.com/g/JayBizzle/Laravel-Crawler-Detect/?branch=master) [![Laravel](https://img.shields.io/badge/laravel-5.*-ff69b4.svg?style=flat-square)](https://laravel.com) [![StyleCI](https://styleci.io/repos/32484055/shield)](https://styleci.io/repos/32484055)

A Laravel 5 wrapper for [CrawlerDetect](https://github.com/JayBizzle/Crawler-Detect) - the web crawler detection library

Installation
============

Run `composer require jaybizzle/laravel-crawler-detect 1.*` or add `"jaybizzle/laravel-crawler-detect": "1.*"` to your `composer.json` file

Add the following to the `providers` array in your `config/app.php` file..

```PHP
  'Jaybizzle\LaravelCrawlerDetect\LaravelCrawlerDetectServiceProvider',
```

...and the following to your `aliases` array...

```PHP
  'Crawler'   => 'Jaybizzle\LaravelCrawlerDetect\Facades\LaravelCrawlerDetect',
```

Usage
==================
```PHP
// Check current 'visitors' user agent
if(Crawler::isCrawler()) {
  // true if crawler user agent detected
}


// Pass a user agent as a string
if(Crawler::isCrawler('Mozilla/5.0 (compatible; aiHitBot/2.9; +https://www.aihitdata.com/about)')) {
  // true if crawler user agent detected
}
