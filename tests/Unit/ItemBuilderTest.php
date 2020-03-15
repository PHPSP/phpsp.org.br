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
            'url'       => 'https://phpsp.org.br/artigos/um-post-bacana',
            'guid'      => 'https://phpsp.org.br/artigos/um-post-bacana',
            'description'   => 'A descricao mais massa que um post bacana poderia ter!',
            'pubDate'   => 1580688000
        ];
        $dom = new DOMDocument();
        $builder = new ItemBuilder();
        $item = $builder->url($post->url)
            ->title($post->title)
            ->description($post->description)
            ->guid($post->guid)
            ->author($post->author)
            ->pubDate(date(DATE_RSS, $post->pubDate))
            ->toDOMElement($dom);
        $dom->appendChild($item);
        
        $reader = new SimpleXMLElement($dom->saveXML());

        $this->assertEquals('Um post bacana!', $reader->title);
        $this->assertEquals('A descricao mais massa que um post bacana poderia ter!', $reader->description);
        $this->assertEquals('https://phpsp.org.br/artigos/um-post-bacana', $reader->url);
        $this->assertEquals('https://phpsp.org.br/artigos/um-post-bacana', $reader->guid);
        $this->assertEquals('Mon, 03 Feb 2020 00:00:00 +0000', $reader->pubDate);
        $this->assertEquals('Jose Filho', $reader->author);
    }
}
