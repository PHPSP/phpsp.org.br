<?php

namespace Phpsp\Site\Builder;

use DOMDocument;
use DOMElement;

class ChannelBuilder
{
    private $title;
    private $link;
    private $description;
    private $language;

    public function title(string $title) : ChannelBuilder
    {
        $this->title = $title;
        
        return $this;
    }

    public function link(string $link) : ChannelBuilder
    {
        $this->link = $link;
        
        return $this;
    }

    public function description(string $description) : ChannelBuilder
    {
        $this->description = $description;
        
        return $this;
    }

    public function language(string $language) : ChannelBuilder
    {
        $this->language = $language;
        
        return $this;
    }

    public function toDOMElement(DOMDocument $dom) : DOMElement
    {
        $channel = $dom->createElement('channel');
        $channel->appendChild($dom->createElement('title', $this->title));
        $channel->appendChild($dom->createElement('link', $this->link));
        $channel->appendChild($dom->createElement('description', $this->description));
        $channel->appendChild($dom->createElement('language', $this->language));

        return $channel;
    }
}