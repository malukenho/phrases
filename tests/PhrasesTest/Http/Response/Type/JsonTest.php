<?php

namespace Phrases\Http\Response\Type;

use Zend\Http;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    public function testCantHandlePlainTextRequests()
    {
        $request = Http\Request::fromString("GET / HTTP/1.1\r\nAccept: plain/text\r\n");
        $handler = new Json();

        $this->assertFalse(
            $handler->canResolve($request)
        );
    }

    public function testCanHandleJsonRequests()
    {
        $request = Http\Request::fromString("GET / HTTP/1.1\r\nAccept: application/json\r\n");
        $handler = new Json();

        $this->assertTrue(
            $handler->canResolve($request)
        );
    }

    public function testSerializationDeliversAPlainTextResultFromAString()
    {
        $givenResponse = 'Gugu lindo!';
        $expectedResponse = '"\"Gugu lindo!\""';
        $handler = new Json();
        $response = new Http\Response;
        $response->setContent($givenResponse);

        $this->assertInstanceOf(
            'Zend\Http\Response',
            $handler->serialize($response)
        );
        $this->assertEquals(
            $expectedResponse,
            $handler->serialize($response)->getBody()
        );
    }

    public function testSerializationDeliversJsonResultFromAnArray()
    {
        $givenResponseContent = array(1, 2);
        $expectedResponse = '[1,2]';
        $handler = new Json();
        $response = new Http\Response;
        $response->setContent($givenResponseContent);

        $this->assertEquals(
            $expectedResponse,
            $handler->serialize($response)->getBody()
        );
    }
}
