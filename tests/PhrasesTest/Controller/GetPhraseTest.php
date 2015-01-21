<?php

namespace Phrases\Controller;

use Zend\Http\Headers;
use Zend\Http\Response;
use Phrases\Persistance\Memory;
use Phrases\Entity\Phrase;

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
        $expectedPhrase = new Phrase('Eu sou lindo', 'Só que não!');
        $phrases = $this->createMemoryPersistanceForPhraseArray([$expectedPhrase]);
        $controller = new GetPhrase($phrases);
        $request = $this->createStubRequestObject();
        $response = $controller->execute($request);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(
            $expectedPhrase->getText(),
            $response->getContent()
        );
    }

    public function testGetSinglePhraseWhenMoreThanOnePhraseExists()
    {
        $expectedPhrase = new Phrase('Eu sou lindo', 'Só que não!');
        $phrase = new Phrase('Eu sou feio', 'Só que é!');
        $phraseList = [$expectedPhrase, $phrase];
        $existingTexts = [];
        foreach ($phraseList as $phrase) {
            array_push($existingTexts, $phrase->getText());
        }
        $phrases = $this->createMemoryPersistanceForPhraseArray($phraseList);
        $controller = new GetPhrase($phrases);
        $request = $this->createStubRequestObject();
        $response = $controller->execute($request);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertContains(
            $response->getContent(),
            $existingTexts
        );
    }
}

