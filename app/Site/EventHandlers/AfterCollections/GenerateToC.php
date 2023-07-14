<?php

namespace Phpsp\Site\EventHandlers\AfterCollections;

use DOMDocument;
use DOMElement;
use DOMXpath;
use Phpsp\Site\EventHandlers\AfterCollections\ToC\Header;
use Phpsp\Site\EventHandlers\JigsawHandlerInterface;
use TightenCo\Jigsaw\Collection\CollectionItem;
use TightenCo\Jigsaw\Jigsaw;

class GenerateToC implements JigsawHandlerInterface
{
    /**
     * @var int $minItemsToDisplay Número mínimo de itens para que o índice seja exibido
     */
    private $minItemsToDisplay;

    /**
     * @var int $maxItemsToDisplay Número máximo de itens a serem exibidos no índice
     */
    private $maxItemsToDisplay;

    private $xpath;

    /**
     * @param int $minItemsToDisplay Número mínimo de itens para que o índice seja exibido
     * @param int $maxItemsToDisplay Número máximo de itens a serem exibidos no índice
     * @param int $minLevel Nível de cabeçalho mínimo a ser exibido
     * @param int $maxLevel Nível de cabeçalho máximo a ser exibido
     */
    public function __construct(int $minItemsToDisplay, int $maxItemsToDisplay, int $minLevel, int $maxLevel)
    {
        $this->minItemsToDisplay = $minItemsToDisplay;
        $this->maxItemsToDisplay = $maxItemsToDisplay;
        $this->xpath = '//h' . \implode(' | //h', \range($minLevel, $maxLevel));
    }

    public function handle(Jigsaw $jigsaw): void
    {
        /** @var \TightenCo\Jigsaw\Collection\CollectionItem $item */
        $collection = $jigsaw->getCollection('posts');
        foreach ($collection as $item) {
            $this->runItem($item);
        }
    }

    private function runItem(CollectionItem $item): void
    {
        $html = $item->getContent();
        if (empty($html)) {
            return;
        }

        $oldValue = \libxml_use_internal_errors(true);
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->loadHTML('<?xml encoding="UTF-8">' . $html);
        \libxml_use_internal_errors($oldValue);

        $xpath = new DOMXpath($dom);
        $nodes = $xpath->query($this->xpath);
        if ($nodes === false) {
            return;
        }
        $nodes = \iterator_to_array($nodes);
        $count = \count($nodes);

        if ($count < $this->minItemsToDisplay) {
            return;
        }

        if ($count >= $this->maxItemsToDisplay) {
            $nodes = $this->pruneHeaders($nodes, $this->maxItemsToDisplay);
        }

        $toc = $this->buildTableOfContents($nodes);
        if ($toc->hasChildren()) {
            $item->set('tableOfContents', $toc);
        }
    }

    private function buildTableOfContents(array $nodes): Header
    {
        $root = new Header(0, 'Root', null);
        $lastElement = $root;

        /** @var DOMElement $node */
        foreach ($nodes as $node) {
            /** @var DOMElement $span */
            foreach ($node->childNodes as $span) {
                if (\strtolower($span->tagName) === 'span') {
                    $header = new Header(
                        (int) substr($node->tagName, 1),
                        $span->textContent,
                        $node->getAttribute('id')
                    );

                    $parent = $this->getParentFor($header, $lastElement);
                    if (!$parent) {
                        $parent = $root;
                    }

                    $parent->addChild($header);
                    $lastElement = $header;

                    break;
                }
            }
        }

        return $root;
    }

    /**
     * Retorna o elemento que deve ser o pai deste cabeçalho
     * @param Header $header
     * @param Header $lastElement
     * @return Header|null
     */
    private function getParentFor(Header $header, Header $lastElement): ?Header
    {
        $level = $header->getLevel();
        $lastLevel = $lastElement->getLevel();

        // Adiciona como filho do último elemento (ex: h2 depois de um h1)
        if ($level > $lastLevel) {
            return $lastElement;
        }

        // Adiciona ao pai (ex: h2 depois de vários h3)
        // É preciso fazer recursivamente os níveis caso alguém coloque um h2 depois de vários h4, por exemplo
        if ($level < $lastLevel) {
            $parent = $lastElement;
            for ($i = $level; $i <= $lastLevel; ++$i) {
                $parent = $parent->getParent();
                if (!$parent) {
                    break;
                }
            }
            return $parent;
        }

        // Se for no mesmo nível, então é um "irmão" do último cabeçalho
        return $lastElement->getParent();
    }

    /**
     * Remove cabeçalhos até que tenhamos $maxTocNodes
     * @param array $nodes
     * @param int $maxTocNodes
     * @return DOMElement[]
     */
    private function pruneHeaders(array $nodes, int $maxTocNodes): array
    {
        $count = \count($nodes);
        for ($levelToRemove = 6; $levelToRemove > 2; $levelToRemove--) {
            foreach ($nodes as $key => $header) {
                $level = (int) substr($header->tagName, 1);
                if ($level === $levelToRemove) {
                    unset($nodes[$key]);
                    if (--$count < $maxTocNodes) {
                        break;
                    }
                }
            }
        }
        return $nodes;
    }
}
