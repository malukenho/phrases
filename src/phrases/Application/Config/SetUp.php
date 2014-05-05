<?php
namespace Phrases\Application\Config;

use Phrases\Reader;

/**
 * Class SetUp
 *
 * @package Phrases\Config
 */
class SetUp
{
    /**
     * @var Reader\AbstractReaderConfig
     */
    private $_readerConfig;

    /**
     * @param Reader\AbstractReaderConfig $reader
     */
    public function __construct(Reader\AbstractReaderConfig $reader)
    {
        $this->_readerConfig = $reader;
    }

    /**
     * @return array
     */
    public function getReaderConfig()
    {
        return $this->_readerConfig;
    }
} 