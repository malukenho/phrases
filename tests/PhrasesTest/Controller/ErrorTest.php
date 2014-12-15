<?php

namespace Phrases\Controller;

class ErrorTest extends \PHPUnit_Framework_TestCase
{
    public function testErrorControllerReturnsHttpStatusCode()
    {
        $request = $this->getMockBuilder('Zend\Http\Request')
            ->getMock();
        $expectedHtpStatus = 404;
        $expectedHttpMessage = 'The cake is a lie';
        $controller = new Error($expectedHtpStatus, $expectedHttpMessage);
        $response = $controller->execute($request);

        $this->assertInstanceOf(
            'Zend\Http\Response',
            $response
        );
        $this->assertEquals(
            $expectedHtpStatus,
            $response->getStatusCode()
        );
        $this->assertEquals(
            $expectedHttpMessage,
            $response->getReasonPhrase()
        );
    }
}
