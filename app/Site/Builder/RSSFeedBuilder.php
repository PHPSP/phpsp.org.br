<?php

namespace Phpsp\Site\Builder;

use Phpsp\Site\Builder\ChannelBuilder;

class RSSFeedBuilder
{
    public function channel() : ChannelBuilder
    {
        $channel = new ChannelBuilder();
        
        return $channel;
    }
}