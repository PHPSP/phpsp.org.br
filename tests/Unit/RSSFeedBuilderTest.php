<?php

namespace Tests\Unit;

use Phpsp\Site\Builder\RSSFeedBuilder;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;
use TightenCo\Jigsaw\Jigsaw;

class RSSFeedBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBuildFullXMLSuccessfully()
    {
        $posts = [
            (object) [
                'title' => 'Como criar um RSS Feed',
                'description' => 'Um RSS Feed serve para...',
                'author' => 'Jose Filho',
                'createdAt' => 1580688000,
                'guid'  => 'http://localhost/criar-feed',
                '_meta'  => (object) [
                    'url' => collect('http://localhost/criar-feed')
                ]
            ],
            (object) [
                'title' => '5 dicas excelentes',
                'description' => 'Com essas 5 dicas...',
                'author' => 'Jose Filho',
                'createdAt' => 1580688000,
                'guid'  => 'http://localhost/5-dicas-excelentes',
                '_meta'  => (object) [
                    'url' => collect('http://localhost/5-dicas-excelentes')
                ]
            ]
        ];
        $jigsaw = $this->createMock(Jigsaw::class);
        $jigsaw->app = (object)[
            'config'    => [
                'baseUrl'   => 'https://phpsp.org.br',
                'title'     => 'Grupo de desenvolvedores de PHP do estado de São Paulo',
                'language'  => 'pt-BR'
            ]
        ];
        $dom = (new RSSFeedBuilder($jigsaw))
            ->build($posts);
        $reader = new SimpleXMLElement($dom->saveXML());

        $this->assertObjectHasAttribute('channel', $reader);
        $this->assertObjectHasAttribute('item', $reader->channel);
        $this->assertCount(2, $reader->channel->item);
    }
}
