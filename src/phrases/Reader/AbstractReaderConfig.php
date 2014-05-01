<?php
namespace Phrases\Reader;

use ArrayObject;

abstract class AbstractReaderConfig extends \ArrayObject
{
    abstract function findBy($entity);
}