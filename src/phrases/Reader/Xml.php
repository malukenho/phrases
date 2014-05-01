<?php
namespace Phrases\Reader;

use \Phrases\Reader\XmlConfig;

class Xml
{
    private $xmlDocument;

    public function __construct($fileName)
    {
        $this->xmlDocument = simplexml_load_file(
            BASE_DIR.'/'.$fileName
        );
    }

    public function getConfig()
    {
        return new XmlConfig($this->xmlDocument);
    }
}