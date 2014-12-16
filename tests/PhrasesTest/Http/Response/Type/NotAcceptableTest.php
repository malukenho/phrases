<?php

namespace Phrases\Http\Response\Type;

use Zend\Http\Response;

class NotAcceptableTest extends \PHPUnit_Framework_TestCase
{
    public function testResponseHasProperHttpStatus()
    {
        $handler = new NotAcceptable;
        $response = new Response;
        $resultingResponse = $handler->serialize($response);

        $this->assertSame(
            $response,
            $resultingResponse,
            'Given response and returned should be the same object.'
        );
        $this->assertEquals(
            406,
            $response->getStatusCode(),
            'HTTP status code should reflect an unhandled "Accept" header.'
        );
    }

    /**
     * @expectedException BadMethodCallException
     * @expectedExceptionMessage This handler does not have any successors.
     */
    public function testSetSuccessThrowsAnException()
    {
        $anotherHandler = new NotAcceptable;
        $handler = new NotAcceptable;
        $handler->setSuccessor($anotherHandler);
    }

    public function testHandlerIsAlwaysAbleToHandleRequests()
    {
        $request = $this->getMock('Zend\Http\Request');
        $handler = new NotAcceptable;
        $this->assertTrue(
            $handler->canResolve($request),
            'This should be able to handle anything.'
        );
    }
}
