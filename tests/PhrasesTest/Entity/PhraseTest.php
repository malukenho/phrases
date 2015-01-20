<?php

namespace Phrases\Entity;

class PhraseTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldSetAndGetAPhraseEntity()
    {
        $title = 'Foo';
        $text  = 'Bar';
        $phrase = new Phrase($title, $text);

        $this->assertEquals($title, $phrase->getTitle());
        $this->assertEquals($text, $phrase->getText());
    }
}
