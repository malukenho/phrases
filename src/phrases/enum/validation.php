<?php
namespace Phrases\Enum;

use Phrases\HTTP;

class Validation
{
    private $class;

    public function __construct(HTTP\AllowedTypesRequested $values)
    {
        $this->class = $values;
    }

    public function hasValue($valueToCheck)
    {
        $reflection = new \ReflectionClass(get_class($this->class));
        return $reflection->hasConstant($valueToCheck);
    }
}