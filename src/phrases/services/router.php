<?php
namespace Phrases\Services;

use Phrases\HTTP;
use Phrases\Enum;
use Phrases\Reader;

class Router
{
	private $_typeOfRequest;
	private $_uri;
	private $_fileToConsult;

	public function setURI($uri)
	{
		$this->_uri = $uri;
		return $this;
	}

	public function fileToConsult($fileName)
	{
		$this->_fileToConsult = $fileName;
		return $this;
	}

	public function httpMethodTypeRequested($typeOfRequest)
	{
		$this->_typeOfRequest = strtoupper($typeOfRequest);

		$methodsAllowed = new Enum\Validation(new HTTP\AllowedTypesRequested);

		if (! $methodsAllowed->hasValue($typeOfRequest)) {
			new HTTP\Response(405, "Method not allowed");
		}

		$httpVerb = HTTP\Verbs\Factory::getMethod($typeOfRequest);

		return $this->_response($httpVerb);
	}

	private function _response($httpVerb)
	{
		$reader = new Reader\Xml($this->_fileToConsult);
		
		return $reader->asXML(
			$this->takePhraseRequired()
		);
	}

    public function takePhraseRequired()
    {
        $getStandardSlugRequired = "#quote/(.[^/]+)#";
        preg_match($getStandardSlugRequired, $this->_uri, $matches);

        if(isset($matches[1]))
                return $matches[1];

        return false;
    }

}