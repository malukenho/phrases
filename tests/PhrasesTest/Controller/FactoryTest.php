<?php

use Phrases\Controller;

/**
 * @small
 */
class FactoryTest extends \PHPUnit_Framework_TestCase
{
    private $persistance;

    public function setUp()
    {
        $this->persistance = $this->getMock('Phrases\Persistence\RepositoryInterface');
    }

    public function testCreateControllerForGetHttpMethod()
    {
        $factory = new Controller\Factory($this->persistance);
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

    public function testCreateControllerForPostHttpMethod()
    {
        $factory = new Controller\Factory($this->persistance);
        $request = $this->getMockBuilder('Zend\Http\Request')
            ->getMock();
        $request->expects($this->once())
            ->method('isGet')
            ->will($this->returnValue(false));
        $resultingController = $factory->forHttpMethod($request);

        $this->assertInstanceOf(
            'Phrases\Controller\Error',
            $resultingController
        );
    }
}
