<?php

namespace Tests\Unit;

use DOMDocument;
use Phpsp\Site\Builder\ItemBuilder;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

class ItemBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGenerateAllItemProperties()
    {
        $post = (object) [
            'title'     => 'Um post bacana!',
            'author'    => 'Jose Filho',
            'url'      => 'https://phpsp.org.br/artigos/um-post-bacana',
            'guid'      => 'https://phpsp.org.br/artigos/um-post-bacana',
            'description'   => 'A descricao mais massa que um post bacana poderia ter!'
        ];

        $dom = new DOMDocument();
        $builder = new ItemBuilder();
        $item = $builder->url($post->url)
            ->title($post->title)
            ->description($post->description)
            ->guid($post->guid)
            ->toDOMElement($dom);
        $dom->appendChild($item);
        
        $reader = new SimpleXMLElement($dom->saveXML());

        $this->assertEquals('Um post bacana!', $reader->title);
        $this->assertEquals('A descricao mais massa que um post bacana poderia ter!', $reader->description);
        $this->assertEquals('https://phpsp.org.br/artigos/um-post-bacana', $reader->url);
        $this->assertEquals('https://phpsp.org.br/artigos/um-post-bacana', $reader->guid);
    }
}