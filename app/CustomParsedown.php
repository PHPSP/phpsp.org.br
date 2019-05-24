<?php

namespace App;

use Parsedown as BaseParsedown;

class CustomParsedown extends BaseParsedown
{
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
        $ext = strtolower(pathinfo($href, PATHINFO_EXTENSION));
        $isImage = in_array($ext, ['gif', 'jpg', 'jpeg', 'png', 'svg']);

        // 1. Add target and rel to external links
        if ($this->isExternalUrl($href) && !$isImage) {
            $link['element']['attributes']['target'] = '_blank';
            $link['element']['attributes']['rel'] = 'noopener';
        }

        return $link;
    }

    /**
     * Check if a URL is internal or external
     * @param string $url
     * @param null $internalHostName
     * @return bool
     */
    protected function isExternalUrl($url, $internalHostName = null)
    {
        $components = parse_url($url);
        $internalHostName = !$internalHostName && isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $internalHostName;
        // we will treat url like '/relative.php' as relative
        if (empty($components['host'])) {
            return false;
        }
        // url host looks exactly like the local host
        if (strcasecmp($components['host'], $internalHostName) === 0) {
            return false;
        }

        $isNotSubdomain = strrpos(strtolower($components['host']), '.' . $internalHostName) !== strlen($components['host']) - strlen('.' . $internalHostName);

        return $isNotSubdomain;
    }
}
