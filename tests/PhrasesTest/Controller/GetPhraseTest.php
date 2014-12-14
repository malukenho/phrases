<?php

namespace Phrases\Controller;

use Zend\Http\Headers;

class GetPhraseTest extends \PHPUnit_Framework_TestCase
{
    private function createStubRequestObject($mimeType = 'plain/text')
    {
        $accept = Headers::fromString('Accept: '.$mimeType);
        $request = $this->getMockBuilder('Zend\Http\Request')
            ->getMock();
        $request->expects($this->once())
            ->method('getHeaders')
            ->will($this->returnValue($accept));

        return $request;
    }

    public function testGetSinglePhraseWhenOnlyOnePhraseExists()
    {
        $expectedPhrase = 'Eu sou lindo';
        $phrases = [$expectedPhrase];
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
        $phrases = [$expectedPhrase, 'Eu sou feio'];
        $controller = new GetPhrase($phrases);
        $request = $this->createStubRequestObject();
        $response = $controller->execute($request);
        $this->assertInstanceOf('Zend\Http\Response', $response);
        $this->assertEquals(
            $expectedPhrase,
            $response->getContent()
        );
    }
}

