<?php

namespace Phpsp\Site\EventHandlers;

use TightenCo\Jigsaw\Jigsaw;

interface JigsawHandlerInterface
{
    public function handle(Jigsaw $jigsaw): void;
}
