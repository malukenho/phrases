<?php
namespace Phrases\HTTP\Verbs;

class GETTest extends \PHPUnit_Framework_TestCase
{

    const CLASS_TESTABLE = 'Phrases\\HTTP\\Verbs\\GET';

    public function setUP()
    {
        $rootPath = __FILE__;

        for ($i=0; $i <= 5; $i++)
            $rootPath = dirname($rootPath);

        defined('BASE_DIR') or define('BASE_DIR', $rootPath);
    }

    /**
     * @test
     */
    public function class_can_be_instanciate()
    {
        if (class_exists(self::CLASS_TESTABLE))
        {

            $getMethod = new GET;
            $this->assertInstanceOf(self::CLASS_TESTABLE, $getMethod);
        }
    } 

    /**
     * @depends class_can_be_instanciate
     * @test
     */ 
    public function class_can_return_values_correctly()
    {

        $getMethod = new GET;
        $this->assertInstanceOf(self::CLASS_TESTABLE, $getMethod);

        $reflection = new \ReflectionObject($getMethod);

        $xmlProperty = $reflection->getProperty('xmlDocument');
        $xmlProperty->setAccessible(true);

        $xml = '<?xml version="1.0" ?>
                <phrases>
                    <quote slug="test">Testable xml</quote>
                    <quote slug="test2">Testable xml2</quote>
                </phrases>';
        
        $xmlProperty->setValue(
            $getMethod, 
            simplexml_load_string($xml)
        );

        ob_start();
        $getMethod->response('test');
        $result = ob_get_contents();
        ob_end_clean();

        $this->assertEquals(
            "<?xml version=\"1.0\"?>\n<phrases><quote>Testable xml</quote></phrases>\n", 
            $result
        );
    
        $this->assertTrue(
            $getMethod->response('test')
        );

        $this->assertFalse(
            $getMethod->response('test3')
        );

    }
}