<?php

namespace Phrases\Controller;

class GetPhraseTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSinglePhraseWhenOnlyOnePhraseExists()
    {
        $expectedPhrase = 'Eu sou lindo';
        $phrases = [$expectedPhrase];
        $controller = new GetPhrase($phrases);
        $this->assertEquals(
            $expectedPhrase,
            $controller->execute()
        );
    }

    public function testGetSinglePhraseWhenMoreThanOnePhraseExists()
    {
        $expectedPhrase = 'Eu sou lindo';
        $phrases = [$expectedPhrase, 'Eu sou feio'];
        $controller = new GetPhrase($phrases);
        $this->assertEquals(
            $expectedPhrase,
            $controller->execute()
        );
    }
}
