<?php
namespace Phrases\Http\Response;

use Zend\Http\Header\Accept;
use PhrasesTestAsset\ConsumedData;

class CreateResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider responseDataAssert
     */
    public function testSwitchTheCorrectResponseType($type, $value, $expected)
    {
        $accept = new Accept();
        $accept->addMediaType($type);

        $response = CreateResponse::to($accept, $value);

        $this->assertEquals($expected, $response->getBody());
        $this->assertInstanceOf('Zend\Http\Response', $response);
    }

    public function responseDataAssert()
    {
        return [
            [
                'acceptType' => 'text/plain',
                'setValue'   => ConsumedData::asArray()[0],
                'expected'   => ConsumedData::asArray()[0]
            ],
            [
                'acceptType' => 'application/json',
                'setValue'   => ConsumedData::asArray()[1],
                'expected'   => '["' . ConsumedData::asArray()[1] . '"]'
            ]
        ];
    }
}
 