<?php

namespace Phpsp\Site\Builder;

use DateTimeImmutable;
use DOMDocument;
use Phpsp\Site\Builder\ChannelBuilder;
use TightenCo\Jigsaw\Jigsaw;

class RSSFeedBuilder
{
    private $jigsaw;

    public function __construct(Jigsaw $jigsaw)
    {
        $this->jigsaw = $jigsaw;
    }

    public function build($posts)
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $rss = $dom->appendChild($dom->createElement('rss'));
        $channelBuilder = new ChannelBuilder();
        $channel = $channelBuilder->title('PHPSP')
            ->description($this->jigsaw->app->config['title'])
            ->link($this->jigsaw->app->config['baseUrl'])
            ->language($this->jigsaw->app->config['language'])
            ->toDOMElement($dom);

        foreach ($posts as $post) {
            $itemBuilder = new ItemBuilder();
            $item = $itemBuilder->url($post->_meta->url->first())
                ->title($post->title)
                ->description($post->description ?? substr(strip_tags($post->getContent()), 0, 200))
                ->author($post->author)
                ->pubDate(date(DATE_RSS, $post->createdAt))
                ->guid($post->_meta->url->first())
                ->toDOMElement($dom);
            $channel->appendChild($item);
        }

        $rss->appendChild($channel);

        return $dom;
    }
}
