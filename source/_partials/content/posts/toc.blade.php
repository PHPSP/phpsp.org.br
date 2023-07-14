<?php /** @var \Phpsp\Site\EventHandlers\AfterCollections\ToC\Header $header */ ?>
<li>
    <a href="#{{ $header->getUrl() }}" class="is-block px-2 py-1">{{ $header->getText() }}</a>
    @if ($header->hasChildren())
    <ul class="ml-3">
        @each('_partials.content.posts.toc', $header->getChildren(), 'header')
    </ul>
    @endif
</li>
