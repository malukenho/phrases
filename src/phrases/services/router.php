<?php
namespace Phrases\Services;

class Router
{
	private $typeOfRequest;

	public function get($uri)
	{
		echo $currentURI = $this->getCurrentURI();
	}

	public function type($typeOfRequest)
	{
		$this->typeOfRequest = (string) strtoupper($typeOfRequest);

		$types = array('GET', 'PUT', 'POST', 'DELETE');

		if(! in_array($this->typeOfRequest, $types))
			$this->typeOfRequest = 'GET';

		return $this;
	}

	private function getCurrentURI()
	{
		return trim(
			str_replace(
				$_SERVER['SCRIPT_NAME'],
				'',
				$_SERVER['REQUEST_URI']
			)
		, '/');
	}
}