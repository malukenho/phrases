<?php

namespace Phrases\Controller;

use Zend\Http\Request;
use Zend\Http\Response;

class ErrorTest extends \PHPUnit_Framework_TestCase
{
    public function testErrorControllerReturnsHttpStatusCode()
    {
        $request = $this->getMockBuilder(Request::class)
            ->getMock();
        $expectedHtpStatus = 404;
        $expectedHttpMessage = 'The cake is a lie';
        $controller = new Error($expectedHtpStatus, $expectedHttpMessage);
        $response = $controller->execute($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals($expectedHtpStatus, $response->getStatusCode());
        $this->assertEquals($expectedHttpMessage, $response->getReasonPhrase());
    }
}
