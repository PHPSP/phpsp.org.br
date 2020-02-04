<?php

namespace Phpsp\Site;

use DOMDocument;

class RssFeedGenerator
{
    public function toXML($post)
    {
        $dom = new DOMDocument();
        $element = $dom->createElement('item');
        $element->appendChild($dom->createElement('title', $post->title));
        dd($dom->saveXML($element));
        return $element;
    }
}