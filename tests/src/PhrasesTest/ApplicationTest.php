<?php
namespace PhrasesTest;

use PHPUnit_Framework_TestCase;
use Phrases\Application;
use PhrasesTest\testProvideAsserts\ConsumedData;

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
}
