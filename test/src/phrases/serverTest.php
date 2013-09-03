<?php
namespace Phrases;

class ServerTest extends \PHPUnit_Framework_TestCase
{
	function testClassCanBeInstanciate()
	{
		$phrases = new Server;
		$this->assertInstanceOf('Phrases\Server', $phrases);
		unset($phrases);
	}

	/**
	 * @depends testClassCanBeInstanciate
	 */
	function testLoadClassesFromRegistry()
	{
		$router = Registry::getService('router');
		$this->assertInstanceOf('Phrases\Services\Router', $router);
		unset($router);
	}
}