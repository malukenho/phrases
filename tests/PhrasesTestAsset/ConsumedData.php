<?php
namespace PhrasesTestAsset;

class ConsumedData
{
    private static $data = [
        'Jack Makiyama',
        'Augusto Pascutti',
        'Jefersson Nathan'
    ];

    public static function asArray()
    {
       return static::$data;
    }
}
