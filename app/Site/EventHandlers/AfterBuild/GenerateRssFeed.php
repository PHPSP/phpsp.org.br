<?php

namespace Phpsp\Site\EventHandlers\AfterBuild;

use Carbon\Carbon;
use DOMDocument;
use Phpsp\Site\Builder\RSSFeedBuilder;
use TightenCo\Jigsaw\Jigsaw;
use Phpsp\Site\EventHandlers\JigsawHandlerInterface;

class GenerateRssFeed implements JigsawHandlerInterface
{
    public function handle(Jigsaw $jigsaw): void
    {
        $builder = $jigsaw->app->make(RSSFeedBuilder::class);
        $dom = $builder->build($jigsaw->getCollection('posts'));
        $dom->formatOutput = true;
        
        file_put_contents('source/feed.xml', $dom->saveXML());
    }
}
