<?php

use Jaybizzle\CrawlerDetect\CrawlerDetect;
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
            'Crawler' => 'Jaybizzle\LaravelCrawlerDetect\Facades\LaravelCrawlerDetect',
        ];
    }

    public function setUp()
    {
        parent::setUp();
        $this->LaravelCrawlerDetect = new CrawlerDetect();
    }

    protected function getEnvironmentSetUp($app)
    {
        // reset base path to point to our package's src directory
        $app['path.base'] = __DIR__.'/../src';
    }

    public function testBots()
    {
        $lines = file('https://raw.githubusercontent.com/JayBizzle/Crawler-Detect/master/tests/crawlers.txt');

        foreach ($lines as $line) {
            $test = Crawler::isCrawler($line);
            $this->assertEquals($test, true, $line);
        }
    }

    public function testDevices()
    {
        $lines = file('https://raw.githubusercontent.com/JayBizzle/Crawler-Detect/master/tests/devices.txt');

        foreach ($lines as $line) {
            $test = Crawler::isCrawler($line);
            $this->assertEquals($test, false, $line);
        }
    }
}
