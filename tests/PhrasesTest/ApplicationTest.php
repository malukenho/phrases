<?php
namespace PhrasesTest;

use Phrases\Application;
use PHPUnit_Framework_TestCase;
use PhrasesTestAsset\ConsumedData;
use Zend\Http\Request;
use Zend\Http\Headers;
use Zend\StdLib\Parameters;

class ApplicationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Application
     */
    private $application;

    public function setUp()
    {
        $this->application = new Application(ConsumedData::asArray());
    }

    public function testGetPhraseAsPlainText()
    {
        $phrases = ConsumedData::asArray();
        $request = new Request;
        $header = new Headers;
        $request->setMethod('GET');
        $request->setUri('http://localhost/');
        $request->setHeaders(Headers::fromString('Accept: plain/text'));
        $app = new Application($phrases, $request);
        $response = $app->fetchResponse();
        $this->assertInstanceOf(
            'Zend\Http\Response',
            $response
        );
        $this->assertEquals(
            200,
            $response->getStatusCode()
        );
        $expectedPhrase = $phrases[0];
        $this->assertEquals(
            $expectedPhrase,
            $response->getBody()
        );
    }

    public function testPostNewPhrase()
    {
        $request = new Request;
        $header = new Headers;
        $parameters = new Parameters([
            'title' => 'É nóis que voa bruxão',
            'text'  => 'hehe'
        ]);
        $request->setMethod('POST');
        $request->setUri('http://localhost/');
        $request->setPost($parameters);
        $app = new Application(ConsumedData::asArray(), $request);
        $response = $app->fetchResponse();
        $this->assertInstanceOf(
            'Zend\Http\Response',
            $response
        );
        $this->assertEquals(
            201,
            $response->getStatusCode()
        );
        $expectedUrlPath = '/e-nois-que-voa-bruxao';
        $this->assertContains(
            $expectedUrlPath,
            $response->getBody(),
            'Expected URL of created Phrase'
        );
    }
}
