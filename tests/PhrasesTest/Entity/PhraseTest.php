<?php

namespace Phrases\Entity;

class PhraseTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @expectedException PHPUnit_Framework_Error
    */
    public function testInstantiationWithoutArgumentsShouldNotWork()
    {
        $phrase = new Phrase();
    }

    public function testInstantiationOfAPhraseIsCompositeWithTitleAndText()
    {
        $title  = 'Eu só acho';
        $text  = 'Eu só acho que eu deveria codar mais =/';

        $phrase = new Phrase($title, $text);

        $this->assertAttributeEquals($title, 'title', $phrase);
        $this->assertAttributeEquals($text, 'text', $phrase);
    }

    public function testShouldGetTheTitleAndText()
    {
        $title = 'Hoje até que rendeu legal';
        $text = 'Acho que pode rolar mais vezes, pois rende bastante, assim não fica só nas costas do Augusto';

        $phrase = new Phrase($title, $text);

        $this->assertEquals($title, $phrase->getTitle());
        $this->assertEquals($text, $phrase->getText());
    }

}

