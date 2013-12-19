<?php
namespace Phrases\Reader;
use \Phrases\Http;

class Xml
{
    private $xmlDocument;

    public function __construct($fileName)
    {
        $this->xmlDocument = simplexml_load_file(
            BASE_DIR.'/'.$fileName
        );

    }

    public function asXML($key)
    {
        Http\Response::contentType('text/xml');

        if ($this->_hasKey($key))
        {
            return $this->_fetchXML($key);
        }

        return false;
    }

    private function _hasKey($keyName)
    {
        $key = $this->xmlDocument->xpath("//quote[@slug='{$keyName}']");

        if (! empty($key)) {
            return true;
        }

        return false;
    }

    private function _fetchXML($keyName)
    {
        $key = $this->xmlDocument->xpath("//quote[@slug='{$keyName}']");

        $xmlDoc = new \SimpleXMLElement('<phrases></phrases>');
        $xmlDoc->quote[] = $key[0];

        return $xmlDoc->asXML();
    }

}