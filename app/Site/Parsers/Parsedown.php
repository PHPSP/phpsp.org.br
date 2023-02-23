<?php

namespace Phpsp\Site\Parsers;

use ParsedownExtra as BaseParsedown;
use function preg_replace;

class Parsedown extends BaseParsedown
{
    private $internalHostName;

    public function __construct(string $internalHostName)
    {
        parent::__construct();
        $this->internalHostName = $internalHostName;
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
}
