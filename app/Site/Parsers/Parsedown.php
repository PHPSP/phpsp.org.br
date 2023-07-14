<?php

namespace Phpsp\Site\Parsers;

use ParsedownExtra as BaseParsedown;
use function preg_replace;

class Parsedown extends BaseParsedown
{
    private $internalHostName;

    private $visitedHeaders = [];

    /**
     * @throws \Exception
     */
    public function __construct(string $internalHostName)
    {
        parent::__construct();
        $this->internalHostName = $internalHostName;
    }

    public function text($text)
    {
        $this->visitedHeaders = [];
        return parent::text($text);
    }

    /**
     * Extra link handling
     * @param  array $excerpt
     * @return array
     */
    protected function inlineLink($excerpt)
    {
        $link = parent::inlineLink($excerpt);
        if (!isset($link)) {
            return null;
        }
        $href = $link['element']['attributes']['href'];
        $href = preg_replace("/[{'@}]+/i", '@', $href);
        $link['element']['attributes']['href'] = $href;

        $ext = strtolower(pathinfo($href, PATHINFO_EXTENSION));
        $isImage = in_array($ext, ['gif', 'jpg', 'jpeg', 'png', 'svg']);

        // 1. Add target and rel to external links
        if ($this->isExternalUrl($href) && !$isImage) {
            $link['element']['attributes']['rel'] = 'nofollow';
        }

        return $link;
    }

    /**
     * Check if a URL is internal or external
     * @param string $url
     * @param null $internalHostName
     * @return bool
     */
    protected function isExternalUrl($url)
    {
        $parsedUrl = parse_url($url);
        if (empty($parsedUrl['host'])) {
            return false;
        }
        $parsedInternalHostUrl = parse_url($this->internalHostName);
        if (strcasecmp($parsedUrl['host'], $parsedInternalHostUrl['host']) === 0) {
            return false;
        }

        $isNotSubdomain = strpos(strtolower($parsedUrl['host']), strtolower($parsedInternalHostUrl['host'])) == false;

        return $isNotSubdomain;
    }

    protected function blockHeader($Line)
    {
        $Block = parent::blockHeader($Line);

        if (!isset($Block)) {
            return null;
        }

        if (!isset($Block['element']['attributes'])) {
            $Block['element']['attributes'] = [];
        }

        // Gera um slug amigável para o título
        $slug = $this->slugify($Block['element']['text']);

        // Se já existe o mesmo título, colocamos um "-2", "-3", ..., no final
        $headerAlreadyExists = isset($this->visitedHeaders[$slug]);
        if (!$headerAlreadyExists) {
            $this->visitedHeaders[$slug] = 1;
        }
        $Block['element']['attributes']['id'] = $slug;
        if ($headerAlreadyExists) {
            $Block['element']['attributes']['id'] .= "-{$this->visitedHeaders[$slug]}";
        }
        $this->visitedHeaders[$slug]++;

        $header = $Block['element']['text'];
        $Block['element']['handler'] = 'elements';
        $Block['element']['text'] = [];
        $Block['element']['text'][] = [
            'name' => 'span',
            'handler' => 'line',
            'text' => $header,
            'attributes' => [
                'class' => 'header-span',
            ],
        ];
        $Block['element']['text'][] = [
            'name' => 'a',
            'handler' => 'line',
            'text' => '¶',
            'attributes' => [
                'href' => "#{$Block['element']['attributes']['id']}",
                'class' => 'pilcrow',
            ],
        ];

        return $Block;
    }

    private function slugify(string $text): string
    {
        return \trim(
            \preg_replace(
                '/[^a-z0-9_\-]+/',
                '-',
                \mb_strtolower(
                    \iconv('utf-8', 'us-ascii//TRANSLIT', $text)
                )
            ),
            '-'
        );
    }
}
