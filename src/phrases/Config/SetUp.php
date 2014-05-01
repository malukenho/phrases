<?php
namespace Phrases\Config;

use Phrases\Reader;
use Phrases\Reader\AbstractReaderConfig;

/**
 * Class SetUp
 *
 * This is a value object
 *
 * @package Phrases\Config
 */
class SetUp
{
    /**
     * @var AbstractReaderConfig
     */
    private $_readerConfig;

    public function __construct(AbstractReaderConfig $reader)
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