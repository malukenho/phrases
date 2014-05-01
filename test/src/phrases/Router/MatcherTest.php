<?php
namespace Phrases\Router;


class MatcherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function class_can_be_instantiated()
    {
        $className = 'Phrases\\Router\\Matcher';

        if (! class_exists($className)) {
            $this->markTestSkipped('Class '.$className.' not found!');
        }

        $matcher = new Matcher();
        $this->assertInstanceOf($className, $matcher);
    }

    public function router_found()
    {

    }
}
 