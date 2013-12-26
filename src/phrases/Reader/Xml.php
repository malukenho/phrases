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
        if ($this->_hasKey($key))
        {
            Http\Response::contentType('text/xml');
            return $this->_fetchXML($key);
        }

        new  Http\Response(404, 'Not Found');
        return $this->_throwError('Not Found');
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

    public function _throwError($string)
    {
        $xmlDoc = new \SimpleXMLElement('<phrases></phrases>');
        $xmlDoc->error = $string;

        return $xmlDoc->asXML();
    }
}