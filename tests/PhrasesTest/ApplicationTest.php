<?php
namespace PhrasesTest;

use Phrases\Application;
use Phrases\Persistance\Memory;
use PHPUnit_Framework_TestCase;
use PhrasesTestAsset\ConsumedData;
use Zend\Http\Request;
use Zend\Http\Headers;
use Zend\StdLib\Parameters;

/**
 * @huge
 */
class ApplicationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Application
     */
    private $application;
    private $persistance;

    public function setUp()
    {
        $phrases = ConsumedData::asArray();
        $onePhrase = array_shift($phrases);
        $this->persistance = new Memory([$onePhrase]);
        $this->application = new Application($this->persistance);
    }

    public function testGetPhraseAsPlainText()
    {
        $request = new Request;
        $request->setMethod('GET');
        $request->setUri('http://localhost/');
        $request->setHeaders(Headers::fromString('Accept: plain/text'));
        $app = new Application($this->persistance, $request);
        $response = $app->fetchResponse();
        $this->assertInstanceOf(
            'Zend\Http\Response',
            $response
        );
        $this->assertEquals(
            200,
            $response->getStatusCode()
        );
        $expectedPhrase = '"Jack Makiyama"';
        $this->assertEquals(
            $expectedPhrase,
            $response->getBody()
        );
    }

    public function testPostNewPhrase()
    {
        $request = new Request;
        $parameters = new Parameters([
            'title' => 'É nóis que voa bruxão',
            'text'  => 'hehe'
        ]);
        $request->setMethod('POST');
        $request->setUri('http://localhost/');
        $request->setPost($parameters);
        $app = new Application($this->persistance, $request);
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
