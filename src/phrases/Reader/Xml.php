<?php
namespace Phrases\Reader;

use Phrases\Reader;
use Phrases\Http;

/**
 * Class Xml
 * @package Phrases\Reader
 */
class Xml implements Reader\IReader
{
    private $documentContent;

    /**
     * @param $content
     */
    public function __construct($content)
    {
        $this->documentContent = $content;
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function findBy($entity)
    {
        $key = $this->documentContent->xpath("//quote[@slug='{$entity}']");

        $xmlDoc = new \SimpleXMLElement('<phrases></phrases>');
        $xmlDoc->quote[] = $key[0];

        Http\Response::contentType('text/xml');
        return $xmlDoc->asXML();
    }
}