<?php
namespace Phrases\Services;

use Phrases\HTTP;
use Phrases\Enum;

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

		$methodsAllowed = new Enum\Validation(new HTTP\AllowedTypesRequested);

		if (! $methodsAllowed->hasValue($typeOfRequest)) {
			new HTTP\Response(405, "Method not allowed");
		}

		$httpVerb = HTTP\Verbs\Factory::getMethod($typeOfRequest);

		return $this;
	}

	public function takePhraseRequired()
	{
		$getStandardSlugRequired = "#quote/(.[^/]+)#";
		preg_match($getStandardSlugRequired, $this->uri, $matches);

		if(isset($matches[1]))
			return $matches[1];

		return false;
	}

}