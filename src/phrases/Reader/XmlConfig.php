<?php
namespace Phrases\Reader;

use \Phrases\Http;
use SimpleXMLElement;

class XmlConfig extends AbstractReaderConfig
{
    private $documentContent;

    public function __construct($content)
    {
        $this->documentContent = $content;
    }

    public function findBy($entity)
    {
        $key = $this->documentContent->xpath("//quote[@slug='{$entity}']");

        $xmlDoc = new SimpleXMLElement('<phrases></phrases>');
        $xmlDoc->quote[] = $key[0];


        Http\Response::contentType('text/xml');
        return $xmlDoc->asXML();
    }
}