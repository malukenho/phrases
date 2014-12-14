<?php

namespace Phrases\Controller;

use Zend\Http\Headers;

class PostPhraseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @TODO: Remove duplicate method (see GetPhraseTest)
     */
    private function createStubRequestObject($mimeType = 'plain/text')
    {
        $accept = Headers::fromString('Accept: '.$mimeType);
        $request = $this->getMockBuilder('Zend\Http\Request')
            ->getMock();
        $request->expects($this->any())
            ->method('getHeaders')
            ->will($this->returnValue($accept));

        return $request;
    }

    public function testPostWithInvalidDataReturnHttpStatuscode400()
    {
        $postData = [
            'title' => 'Lorem ipsum'
        ];

        $post = new PostPhrase($postData);
        $request = $this->createStubRequestObject();
        $response = $post->execute($request);

        $this->assertInstanceOf('Zend\Http\Response', $response);
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testPostWithValidDataReturnHttpStatuscode201()
    {
        $postData = [
            'title' => 'Lorem ipsum',
            'text'  => 'Lorem ipsum'
        ];

        $post = new PostPhrase($postData);
        $request = $this->createStubRequestObject();
        $response = $post->execute($request);

        $this->assertInstanceOf('Zend\Http\Response', $response);
        $this->assertEquals(201, $response->getStatusCode());
    }
}
