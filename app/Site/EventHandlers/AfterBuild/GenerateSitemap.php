<?php

namespace Phpsp\Site\EventHandlers\AfterBuild;

use TightenCo\Jigsaw\Jigsaw;
use PODEntender\SitemapGenerator\Adapter\Jigsaw\JigsawAdapter;
use Phpsp\Site\EventHandlers\JigsawHandlerInterface;

class GenerateSitemap implements JigsawHandlerInterface
{
    const SITEMAP_POSTS_FILENAME = 'sitemap-posts.xml';
    const SITEMAP_CONTENTS_FILENAME = 'sitemap-contents.xml';

    public function handle(Jigsaw $jigsaw): void
    {
        $output = $jigsaw->getDestinationPath() . DIRECTORY_SEPARATOR;

        /** @var JigsawAdapter $generator */
        $generator = $jigsaw->app->make(JigsawAdapter::class);

        $postsSitemap = $generator->fromCollection($jigsaw->getCollection('posts'));
        file_put_contents($output . self::SITEMAP_POSTS_FILENAME, $postsSitemap->saveXML());

        $contentsSitemap = $generator->fromCollection($jigsaw->getCollection('contents'));
        file_put_contents($output . self::SITEMAP_CONTENTS_FILENAME, $contentsSitemap->saveXML());
    }
}
