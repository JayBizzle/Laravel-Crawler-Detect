<?php

use Jaybizzle\LaravelCrawlerDetect\LaravelCrawlerDetect;
use Orchestra\Testbench\TestCase;

class UATests extends TestCase
{
	protected $LaravelCrawlerDetect;

	protected function getPackageProviders($app)
	{
		return ['Jaybizzle\LaravelCrawlerDetect\LaravelCrawlerDetectServiceProvider'];
	}

	protected function getPackageAliases($app)
	{
	    return [
	        'Crawler' => 'Jaybizzle\LaravelCrawlerDetect\Facades\LaravelCrawlerDetect'
	    ];
	}

	public function setUp()
	{
		parent::setUp();
		$this->LaravelCrawlerDetect = new LaravelCrawlerDetect;
	}

	protected function getEnvironmentSetUp($app)
	{
		// reset base path to point to our package's src directory
		$app['path.base'] = __DIR__ . '/../src';
	}

	public function testBots()
	{
		$lines = file(__DIR__ . '/crawlers.txt');

		foreach($lines as $line) {
			//dd(Crawler::isCrawler($line));
			$test = Crawler::isCrawler($line);
			$this->assertEquals($test, true, $line);
		}
	}
}