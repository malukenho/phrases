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
    private $_uriMatch;

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

    public function uri($uriMatch)
    {
        $uriMatch = trim($uriMatch, '/');
        $uriMatch = str_replace('*', '(.[^/]+)', $uriMatch);
        $this->_uriMatch = "#{$uriMatch}#";
        return $this;
    }

	public function httpVerb($typeOfRequest)
	{
		$this->_typeOfRequest = strtoupper($typeOfRequest);

		$methodsAllowed = new Enum\Validation(new HTTP\AllowedTypesRequested);

		if (! $methodsAllowed->hasValue($typeOfRequest)) {
			new HTTP\Response(405, "Method not allowed");
		}

		$httpVerb = HTTP\Verbs\Factory::getMethod($typeOfRequest);

		return $this;
	}

    public function dispatch()
    {
        return $this->_response($this->_typeOfRequest);
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
        preg_match($this->_uriMatch, $this->_uri, $matches);

        if(isset($matches[1]))
                return $matches[1];

        return false;
    }

}