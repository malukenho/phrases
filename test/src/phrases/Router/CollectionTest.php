<?php
namespace Phrases\Router;

use ReflectionObject;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    public function factoryRoutersToTests()
    {
        return array(
            array('/quote/(.+)', 'quote'),
            array('/phrase-809%-1@#!$/test', 'test'),
            array('/other-thing to%20test/(\d+)', 'finishTest')
        );
    }

    /**
     * @test
     */
    public function collection_is_a_singleton()
    {
        $primaryInstance = Collection::getInstance();
        $secondInstance = Collection::getInstance();

        $this->assertInstanceOf('Phrases\\Router\\Collection', $primaryInstance);
        $this->assertInstanceOf('Phrases\\Router\\Collection', $secondInstance);

        $this->assertEquals(
            spl_object_hash($primaryInstance),
            spl_object_hash($secondInstance)
        );
    }

    /**
     * @test
     * @dataProvider factoryRoutersToTests
     */
    public function collection_can_store_routers($router, $execute)
    {
        $collection = Collection::getInstance();
        $collection->registerRouter($router, $execute);

        $reflection = new ReflectionObject($collection);

        $_router = $reflection->getProperty('_router');
        $_router->setAccessible(true);

        $_routerInformation = $_router->getValue($collection);

        foreach ($_routerInformation as $uri => $exec)
        {
            $this->assertEquals($uri, $router);
            $this->assertEquals($exec, $execute);

            $collection->removeRouter($uri);
        }
    }
}