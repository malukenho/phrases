<?php
namespace Phrases\Reader\Configuration;

use Phrases\Reader;

class Factory
{
    /**
     * @param $baseName
     * @return string
     */
    private function getFullFilePathFromBaseName($baseName)
    {
        return  BASE_DIR.'/'.$baseName;
    }

    /**
     * @param $fileName
     * @return Reader\Xml
     */
    public function createXmlConfigurationForFileName($fileName)
    {
        $fullFilePath = $this->getFullFilePathFromBaseName($fileName);
        $simpleXmlObject = simplexml_load_file($fullFilePath);
        return new Reader\Xml($simpleXmlObject);
    }
} 