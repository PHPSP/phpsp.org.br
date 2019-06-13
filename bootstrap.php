<?php

use TightenCo\Jigsaw\Jigsaw;
use Mni\FrontYAML\Markdown\MarkdownParser as BaseParser;
use Phpsp\Site\Parsers\MarkdownParser;
use Phpsp\Site\Parsers\Parsedown;

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