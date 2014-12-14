<?php

use Phrases\Controller;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateControllerForGetHttpMethod()
    {
        $factory = new Controller\Factory;
        $request = $this->getMockBuilder('Zend\Http\Request')
            ->getMock();
        $request->expects($this->once())
            ->method('isGet')
            ->will($this->returnValue(true));
        $resultingController = $factory->forHttpMethod($request);

        $this->assertInstanceOf(
            'Phrases\Controller\ExecutionInterface',
            $resultingController
        );
    }

    /**
     * @expectedException Exception
     * @TODO Expect a controller that returns an error
     */
    public function testCreateControllerForPostHttpMethod()
    {
        $factory = new Controller\Factory;
        $request = $this->getMockBuilder('Zend\Http\Request')
            ->getMock();
        $request->expects($this->once())
            ->method('isGet')
            ->will($this->returnValue(false));
        $resultingController = $factory->forHttpMethod($request);

        // Missing implementation ----v
        $this->assertInstanceOf(
            'Phrases\Controller\ErrorController',
            $resultingController
        );
    }
}
