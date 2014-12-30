<?php

namespace Phrases\Entity;

class PhraseTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->phrase = new Phrase;
    }

    public function testSetTitleWithValidDataShouldWork()
    {
        $title  = 'Eu só acho';
        $phrase = $this->phrase;

        $return = $phrase->setTitle($title);

        $this->assertEquals($return, $phrase);
        $this->assertAttributeEquals($title, 'title', $phrase);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Title empty not valid
     */
    public function testSetTitleWithInvalidDataDontWork()
    {
        $title = null;
        $phrase = $this->phrase;

        $phrase->setTitle($title);
    }

    public function testShouldSetAndGetTheTitle()
    {
        $title = 'Hoje até que rendeu legal';
        $phrase = $this->phrase;
        $phrase->setTitle($title);

        $this->assertEquals($title, $phrase->getTitle());
    }

    public function testSetTextWithValidDataShouldWork()
    {
        $text  = 'Eu só acho que eu deveria codar mais =/';
        $phrase = $this->phrase;

        $return = $phrase->setText($text);

        $this->assertEquals($return, $phrase);
        $this->assertAttributeEquals($text, 'text', $phrase);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Text empty not valid
     */
    public function testSetTextWithInvalidDataDontWork()
    {
        $text = null;
        $phrase = $this->phrase;

        $phrase->setText($text);
    }

    public function testShouldSetAndGetTheText()
    {
        $text = 'Acho que pode rolar mais vezes, pois rende bastante, assim não fica só nas costas do Augusto';
        $phrase = $this->phrase;
        $phrase->setText($text);

        $this->assertEquals($text, $phrase->getText());
    }
}

