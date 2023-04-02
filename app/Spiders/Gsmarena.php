<?php

namespace App\Spiders;

use Generator;
use RoachPHP\Downloader\Middleware\RequestDeduplicationMiddleware;
use RoachPHP\Extensions\LoggerExtension;
use RoachPHP\Extensions\StatsCollectorExtension;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use RoachPHP\Spider\ParseResult;

class Gsmarena extends BasicSpider
{
    public array $startUrls = [
        'https://www.gsmarena.com'
    ];

    public array $downloaderMiddleware = [
        RequestDeduplicationMiddleware::class,
    ];

    public array $spiderMiddleware = [
        //
    ];

    public array $itemProcessors = [
        //
    ];

    public array $extensions = [
        LoggerExtension::class,
        StatsCollectorExtension::class,
    ];

    public int $concurrency = 2;

    public int $requestDelay = 1;

    /**
     * @param Response $response
     * @return Generator<ParseResult>
     */
    public function parse(Response $response): Generator
    {
        $title = $response->filter('a')->links();
        foreach($title as $v) {
            dump($v->getUri());
        }

        yield $this->item([
            'title' => $title,
        ]);
    }
}
