<?php

namespace Phrases\Http\Response\Type;

use Zend\Http;

class PlainTextTest extends \PHPUnit_Framework_TestCase
{
    public function testCanHandlePlainTextRequests()
    {
        $request = Http\Request::fromString("GET / HTTP/1.1\r\nAccept: plain/text\r\n");
        $handler = new PlainText();

        $this->assertTrue(
            $handler->canResolve($request)
        );
    }

    public function testSerializationDeliversAPlainTextResultFromAString()
    {
        $expectedResponse = 'Gugu lindo!';
        $handler = new PlainText();
        $response = new Http\Response;
        $response->setContent($expectedResponse);

        $this->assertInstanceOf(
            'Zend\Http\Response',
            $handler->serialize($response)
        );
        $this->assertEquals(
            $expectedResponse,
            $handler->serialize($response)->getBody()
        );
    }

    public function testSerializationDeliversAPlainTextResultFromAHtmlString()
    {
        $givenResponseContent = '<p>Gugu lindo!</p>';
        $expectedResponse = '&lt;p&gt;Gugu lindo!&lt;/p&gt;';
        $handler = new PlainText();
        $response = new Http\Response;
        $response->setContent($givenResponseContent);

        $this->assertEquals(
            $expectedResponse,
            $handler->serialize($response)->getBody()
        );
    }
}
