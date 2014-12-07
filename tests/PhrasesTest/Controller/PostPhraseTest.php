<?php

namespace Phrases\Controller;

class PostPhraseTest extends \PHPUnit_Framework_TestCase
{
 
    public function testPostWithInvalidDataReturnHttpStatuscode400()
    {
        $postData = [
            'title' => 'Lorem ipsum'
        ];

        $post = new PostPhrase($postData);
        $response = $post->execute();

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
        $response = $post->execute();

        $this->assertInstanceOf('Zend\Http\Response', $response);
        $this->assertEquals(201, $response->getStatusCode());
    }
}
