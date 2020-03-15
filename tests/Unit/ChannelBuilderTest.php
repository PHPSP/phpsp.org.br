<?php

namespace Tests\Unit;

use DOMDocument;
use Phpsp\Site\Builder\ChannelBuilder;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

class ChannelBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGenerateAllChannelProperties()
    {
        $dom = new DOMDocument();
        $builder = new ChannelBuilder();
        $channel = $builder->title('PHPSP')
            ->description('Um blog massa')
            ->link('https://phpsp.org.br')
            ->language('pt-BR')
            ->toDOMElement($dom);
        $dom->appendChild($channel);
        $dom->formatOutput = true;
        $reader = new SimpleXMLElement($dom->saveXML());

        $this->assertEquals('PHPSP', $reader->title);
        $this->assertEquals('Um blog massa', $reader->description);
        $this->assertEquals('https://phpsp.org.br', $reader->link);
        $this->assertEquals('pt-BR', $reader->language);
    }
}
