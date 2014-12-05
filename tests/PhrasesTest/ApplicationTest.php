<?php
namespace PhrasesTest;

use Phrases\Application;
use PHPUnit_Framework_TestCase;
use PhrasesTestAsset\ConsumedData;

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

    public function testApplicationCanStorageThePhrases()
    {
        $this->assertEquals(ConsumedData::asArray(), $this->application->getPhrases());
    }

    public function testApplicationReturnOnePhrase()
    {
        $phrase = $this->application->getPhrase();
        $consumedData = ConsumedData::asArray();

        $this->assertEquals($consumedData[0], $phrase);
    }

    public function testPostNewPhrase()
    {
        
    }
}
