<?php

namespace Phpsp\Site\EventHandlers\AfterBuild;

use Phpsp\Site\EventHandlers\JigsawHandlerInterface;
use PODEntender\SitemapGenerator\Adapter\Jigsaw\JigsawAdapter;
use TightenCo\Jigsaw\Jigsaw;

class GenerateSitemap implements JigsawHandlerInterface
{
    const SITEMAP_FILENAME = 'sitemap.xml';

    public function handle(Jigsaw $jigsaw): void
    {
        $output = $jigsaw->getDestinationPath() . DIRECTORY_SEPARATOR . self::SITEMAP_FILENAME;

        /** @var JigsawAdapter $generator */
        $generator = $jigsaw->app->make(JigsawAdapter::class);

        $xmlSitemap = $generator->fromCollection($jigsaw->getCollection('posts'));

        file_put_contents($output, $xmlSitemap->saveXML());
    }
}
