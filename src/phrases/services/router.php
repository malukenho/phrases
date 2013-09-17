<?php
namespace Phrases\Services;

class Router
{
	private $typeOfRequest;
	private $uri;

	public function setURI($uri)
	{
		$this->uri = $uri;
		return $this;
	}

	public function httpMethodTypeRequested($typeOfRequest)
	{
		$this->typeOfRequest = strtoupper($typeOfRequest);

		$availableTypes = array('GET', 'PUT', 'POST');

		if(! in_array($this->typeOfRequest, $availableTypes))
			$this->typeOfRequest = 'GET';

		return $this;
	}

	public function takePhraseRequired()
	{
		$getStandardSlugRequired = "#quote/(.[^/]+)#";
		preg_match($getStandardSlugRequired, $this->uri, $matches);

		if(isset($matches[1]))
			return $matches[1];

		return FALSE;
	}

}