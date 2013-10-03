<?php
namespace Phrases\HTTP\Verbs;

class GET
{
    private $xmlDocument;

    public function __construct()
    {
        $this->xmlDocument = simplexml_load_file(
            BASE_DIR.'/phrases.xml'
        );

    }

    private function hasKey($keyName)
    {

        $key = $this->xmlDocument->xpath("//quote[@slug='{$keyName}']");

        if(! empty($key))
        {
            return true;
        }

        return false;
    }

    private function fetchXML($keyName)
    {
        $key = $this->xmlDocument->xpath("//quote[@slug='{$keyName}']");

        header("Content-Type: text/xml");

        $xmlDoc = new \SimpleXMLElement('<phrases></phrases>');
        $xmlDoc->quote[] = $key[0];

        return $xmlDoc->asXML();
    }

    public function response($key)
    {
        if ($this->hasKey($key))
        {
            echo $this->fetchXML($key);
            return true;
        }

        new \Phrases\HTTP\Response(404, "Not Found");
        return false;
    }
}