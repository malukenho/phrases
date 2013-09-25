<?php
namespace Phrases\enum;

use \Phrases\HTTP\AllowedTypesRequested;

class ValidationTest extends \PHPUnit_Framework_TestCase
{
     public function testEnumValidationClassCanBeInstanciate()
     {
         $enum = new Validation(new AllowedTypesRequested());
         $this->assertInstanceOf('Phrases\Enum\Validation', $enum);
     }

    /**
     * @depends testEnumValidationClassCanBeInstanciate
     */
    public function testIfEnumCanSearchByAValueExistents()
    {
        $enum = new Validation(new AllowedTypesRequested());
        $this->assertTrue($enum->hasValue('GET'));
        $this->assertFalse($enum->hasValue('get'));
        $this->assertFalse($enum->hasValue('DELETE'));
    }

} 