<?php

namespace Phpsp\Site\Parsers;

use Mni\FrontYAML\Markdown\MarkdownParser as BaseParser;

class MarkdownParser implements BaseParser
{

    /**
     * MarkdownParser constructor.
     */
    public function __construct(Parsedown $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param  string $markdown
     * @return  string
     */
    public function parse($markdown)
    {
        return $this->parser->parse($markdown);
    }
}
