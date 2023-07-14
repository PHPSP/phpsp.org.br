<?php

use Phpsp\Site\EventHandlers\AfterBuild\GenerateSitemap;
use Phpsp\Site\EventHandlers\AfterBuild\GenerateRssFeed;
use Mni\FrontYAML\Markdown\MarkdownParser as BaseParser;
use Phpsp\Site\EventHandlers\AfterCollections\GenerateToC;
use Phpsp\Site\Parsers\MarkdownParser;
use Phpsp\Site\Parsers\Parsedown;
use TightenCo\Jigsaw\Jigsaw;

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */

/**
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */

$container->bind(BaseParser::class, MarkdownParser::class);
$container->bind(Parsedown::class, function ($app) {
    return new Parsedown($app->config['baseUrl']);
});
$container->bind(GenerateToC::class, function ($app) {
    return new GenerateToC(
        $app->config['toc']['min_items_to_display'],
        $app->config['toc']['max_items_to_display'],
        $app->config['toc']['min_heading_level'],
        $app->config['toc']['max_heading_level'],
    );
});

$events->afterBuild([
    GenerateSitemap::class,
    GenerateRssFeed::class,
]);

$events->afterCollections(function (Jigsaw $jigsaw) use ($container) {
    $container->get(GenerateToC::class)->handle($jigsaw);
});
