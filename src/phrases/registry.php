<?php
namespace Phrases;

class Registry
{
	private static $services = array();

	private function __construct(){}
	
	public static function getService($serviceName)
	{
		if(array_key_exists($serviceName, self::$services))
			return self::$services[$serviceName];

		$class = __NAMESPACE__."\\Services\\$serviceName";

		self::$services[$serviceName] = new $class;
		return self::$services[$serviceName];
	}

}