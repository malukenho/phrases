<?php
namespace Phrases\Services;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    public function testRouterClassCanReturnSlugRequiredCorrectly()
    {
        $router =   new Router;

        $slug   =   $router->setURI('phrases/quote')
                           ->getPhraseSlug();
        
        $this->assertFalse($slug);
        
        $slug   =   $router->setURI('phrases/quote/random')
                           ->getPhraseSlug();
        
        $this->assertEquals('random', $slug);

        $slug   =   $router->setURI('phrases/quote/random/')
                           ->getPhraseSlug();
        
        $this->assertEquals('random', $slug);

        $slug   =   $router->setURI('phrases/quote/hello-word')
                           ->getPhraseSlug();
        
        $this->assertEquals('hello-word', $slug);

        $slug   =   $router->setURI('phrases/quote/uri-required/this-value-not-is-valid')
                           ->getPhraseSlug();
        
        $this->assertEquals('uri-required', $slug);

        unset($router);

    }

    public function testRouterClassCanInstanciateMethodOfRequestCorrectly()
    {

    }
}