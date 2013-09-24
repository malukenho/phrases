<?php
namespace Phrases\Services;

class RouterTest extends \PHPUnit_Framework_TestCase
{

    public function providerURIDataAndExpectedResult() 
    {
        return array(
            array('phrases/quote', 'false'),
            array('phrases/quote/random', 'random'),
            array('phrases/quote/random/', 'random'),
            array('phrases/quote/hello-word', 'hello-word'),
            array('phrases/quote/uri-required/this-value-not-is-valid', 'uri-required')
        );
    }

    /**
     * @dataProvider providerURIDataAndExpectedResult
     */
    public function testClassRouterCanStorageURICorrectly($url)
    {
        $router = new Router;

        $reflection = new \ReflectionClass(get_class($router));

        $this->assertTrue($reflection->hasProperty('uri'), 
            'Class has not a property called "uri"');

        $router->setURI($url);

        $uriProperty = $reflection->getProperty('uri');
        $uriProperty->setAccessible(true);

        $this->assertEquals($uriProperty->getValue($router), $url, 'Ooops! The value is not correctly storaged in uri property on class ' . get_class($router));

    }

    /**
     * @depends testClassRouterCanStorageURICorrectly
     * @dataProvider providerURIDataAndExpectedResult
     */
    public function testRouterClassCanReturnSlugRequiredCorrectly($url, $expected)
    {
        $router =   new Router;

        $slug   =   $router->setURI($url)
                           ->takePhraseRequired();

        if ($expected === 'false') {
            $this->assertFalse($slug);
            return 0;
        }

        $this->assertEquals($slug, $expected);
        

    }

}