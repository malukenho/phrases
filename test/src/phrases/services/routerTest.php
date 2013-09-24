<?php
namespace Phrases\Services;

class RouterTest extends \PHPUnit_Framework_TestCase
{

    public function provider() 
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
     * @dataProvider provider
     */
    public function testRouterClassCanReturnSlugRequiredCorrectly($url, $expected)
    {
        $router =   new Router;

        $slug   =   $router->setURI($url)
                           ->takePhraseRequired();

        if ($expected === 'false') 
        {
            $this->assertFalse($slug);
            return 1;
        }

        $this->assertEquals($slug, $expected);
        

    }

}