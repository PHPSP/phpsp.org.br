<?php

namespace Phpsp\Site\Builder;

use DOMDocument;
use DOMElement;

class ItemBuilder
{
    private $title;
    private $description;
    private $link;
    private $guid;

    public function title(string $title) : ItemBuilder
    {
        $this->title = $title;

        return $this;
    }

    public function description(string $description) : ItemBuilder
    {
        $this->description = $description;

        return $this;
    }

    public function url(string $url) : ItemBuilder
    {
        $this->url = $url;

        return $this;
    }

    public function guid(string $guid) : ItemBuilder
    {
        $this->guid = $guid;

        return $this;
    }

    public function toDOMElement(DOMDocument $dom) : DOMElement
    {
        $item = $dom->createElement('item');
        $item->appendChild($dom->createElement('title', $this->title));
        $item->appendChild($dom->createElement('description', $this->description));
        $item->appendChild($dom->createElement('url', $this->url));
        $item->appendChild($dom->createElement('guid', $this->guid));

        return $item;
    }
}