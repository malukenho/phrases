<?php
namespace PhrasesTest;

use Phrases\Application;
use PHPUnit_Framework_TestCase;
use PhrasesTestAsset\ConsumedData;

class ApplicationTest extends PHPUnit_Framework_TestCase
{
    private $application;

    public function setUp()
    {
        $this->application = new Application(ConsumedData::asArray());
    }

    public function testIfClassCanBeInstantiated()
    {
        $app = new Application([]);
        $this->assertInstanceOf('Phrases\\Application', $app);
    }

    public function testIfClassCanStorageThePhrases()
    {
        $this->assertEquals(ConsumedData::asArray(), $this->application->getPhrases());
    }

    public function testIfClassReturnOnePhrase()
    {
        $phrase = $this->application->getOnePhrase();
        $consumedData = ConsumedData::asArray();

        $this->assertEquals($consumedData[0], $phrase);
    }

    public function testIfApplicationWasRun()
    {
        $consumedData = ConsumedData::asArray();
        
        $this->expectOutputString($consumedData[0]);
        $this->application->run();
    }
}
