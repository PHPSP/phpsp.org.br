<?php

use TightenCo\Jigsaw\Jigsaw;
use Mni\FrontYAML\Markdown\MarkdownParser;
use App\CustomMarkdownParser;

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

$container->bind(MarkdownParser::class, CustomMarkdownParser::class);

