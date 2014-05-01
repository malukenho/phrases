<?php
namespace Phrases\Reader;

class PhraseTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	function class_can_be_instanciate()
	{
		// $instance = new Phrase();
		// $this->assertInstanceOf('Phrases\\Reader\\Phrase', $instance);
	}

	/** @te st */
	function class_can_storage_reader()
	{
		$instance = new Phrase();
		$reflection = new \ReflectionObject($instance);

        $readerProperty = $reflection->getProperty('_reader');
        $readerProperty->setAccessible(true);

        $this->assertNull($this->_reader);
	}
}