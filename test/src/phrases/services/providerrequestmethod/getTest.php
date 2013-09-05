<?php
namespace Phrases\Services\ProviderRequestMethod;

class GetTest extends \PHPUnit_Framework_TestCase
{
	public function testGetClassCanBeInstanciate()
	{
		$getMethod = new Get;
		$this->assertInstanceOf('Phrases\Services\ProviderRequestMethod\Get', $getMethod);
		$this->assertTrue($getMethod instanceof RequestMethod);
		unset($getMethod);
	}

	public function testResponseMethodOfGetClass()
	{
		
	}
}