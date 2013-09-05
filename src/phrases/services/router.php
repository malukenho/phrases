<?php
namespace Phrases\Services;

class Router
{
	private $typeOfRequest;
	private $uri;

	public function setURI($uri)
	{
		$this->uri = $uri . '/';
		return $this;
	}

	public function type($typeOfRequest)
	{
		$this->typeOfRequest = (string) strtoupper($typeOfRequest);

		$types = array('GET', 'PUT', 'POST');

		if(! in_array($this->typeOfRequest, $types))
			$this->typeOfRequest = 'GET';

		return $this;
	}

	private function takePhraseRequired()
	{
		$pattern = "#quote/(.[^/]+)#";
		preg_match($pattern, $this->uri, $matches);

		if(isset($matches[1]))
			return $matches[1];

		return FALSE;
	}

	public function getPhraseSlug()
	{
		return $this->takePhraseRequired();
	}
}