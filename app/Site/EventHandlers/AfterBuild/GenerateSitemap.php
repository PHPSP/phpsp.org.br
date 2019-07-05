<?php

namespace Phpsp\Site\EventHandlers\AfterBuild;

use TightenCo\Jigsaw\Jigsaw;
use PODEntender\SitemapGenerator\Adapter\Jigsaw\JigsawAdapter;
use Phpsp\Site\EventHandlers\JigsawHandlerInterface;

class GenerateSitemap implements JigsawHandlerInterface
{
    private $sitemaps = [
        'posts' => 'sitemap-posts.xml',
        'contents' => 'sitemap-contents.xml',
    ];

    public function handle(Jigsaw $jigsaw): void
    {
        $output = $jigsaw->getDestinationPath() . DIRECTORY_SEPARATOR;

        /** @var JigsawAdapter $generator */
        $generator = $jigsaw->app->make(JigsawAdapter::class);

        foreach ($this->sitemaps as $collectionName => $sitemap) {
            $sitemapXml = $generator->fromCollection($jigsaw->getCollection($collectionName));
            file_put_contents($output . $sitemap, $sitemapXml->saveXML());
        }
    }
}
