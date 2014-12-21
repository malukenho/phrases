<?php

namespace Phrases\Controller;

use Zend\Http\Headers;
use Phrases\Persistance\Memory;

/**
 * @medium
 */
class GetPhraseTest extends \PHPUnit_Framework_TestCase
{
    private function createStubRequestObject($mimeType = 'plain/text')
    {
        return $this->getMockBuilder('Zend\Http\Request')
            ->getMock();
    }

    private function createMemoryPersistanceForPhraseArray(array $list)
    {
        return new Memory($list);
    }

    public function testGetSinglePhraseWhenOnlyOnePhraseExists()
    {
        $expectedPhrase = 'Eu sou lindo';
        $phrases = $this->createMemoryPersistanceForPhraseArray([$expectedPhrase]);
        $controller = new GetPhrase($phrases);
        $request = $this->createStubRequestObject();
        $response = $controller->execute($request);
        $this->assertInstanceOf('Zend\Http\Response', $response);
        $this->assertEquals(
            $expectedPhrase,
            $response->getContent()
        );
    }

    public function testGetSinglePhraseWhenMoreThanOnePhraseExists()
    {
        $expectedPhrase = 'Eu sou lindo';
        $phraseList = [$expectedPhrase, 'Eu sou feio'];
        $phrases = $this->createMemoryPersistanceForPhraseArray($phraseList);
        $controller = new GetPhrase($phrases);
        $request = $this->createStubRequestObject();
        $response = $controller->execute($request);
        $this->assertInstanceOf('Zend\Http\Response', $response);
        $this->assertContains(
            $response->getContent(),
            $phraseList
        );
    }
}

