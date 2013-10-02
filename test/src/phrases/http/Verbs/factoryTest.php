<?php
namespace Phrases\HTTP\Verbs;

class FactoryTest extends \PHPUnit_Framework_TestCase
{

    public function methodsAllowed()
    {
        return array(
            array('GET', 'Phrases\\HTTP\\Verbs\\GET'),
            array('POST', 'Phrases\\HTTP\\Verbs\\POST'),
            array('PUT', 'Phrases\\HTTP\\Verbs\\PUT')
        );
    }

    /**
     * @dataProvider methodsAllowed
     * @test
     */
    public function class_return_class_verbs($verb, $classExpected)
    {
        $verbInstance = Factory::getMethod($verb);
        $this->assertInstanceOf($classExpected, $verbInstance);
    }
}