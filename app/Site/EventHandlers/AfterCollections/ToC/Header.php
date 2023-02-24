<?php

namespace Phpsp\Site\EventHandlers\AfterCollections\ToC;

class Header
{
    /**
     * @var int
     */
    private $level;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $url;

    /**
     * @var Header|null
     */
    private $parent = null;

    /**
     * @var Header[]
     */
    private $children = [];

    public function __construct(int $level, string $text, string $url = null)
    {
        $this->level = $level;
        $this->text = $text;
        $this->url = $url ?? '';
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return Header|null
     */
    public function getParent(): ?Header
    {
        return $this->parent;
    }

    /**
     * @param Header|null $parent
     * @return $this
     */
    public function setParent(?Header $parent): self
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasChildren(): bool
    {
        return !empty($this->children);
    }

    /**
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param Header $child
     * @return $this
     */
    public function addChild(Header $child): self
    {
        $child->setParent($this);
        $this->children[] = $child;
        return $this;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }
}
