<?php
namespace PhrasesTestAsset;

class ConsumedData
{
    private static $data = [
        'Jack Makiyama',
        'Augusto Pascutti',
        'Jefersson Nathan'
    ];

    private static $relationalData = [
        ['id'=>1, 'title'=>'test', 'text'=>'Something interesting, but not interesting enough.'],
        ['id'=>2, 'title'=>'Something', 'text'=>'It is always something.'],
        ['id'=>3, 'title'=>'Atlas Shrugged', 'text'=>'You should really read this book.'],
        ['id'=>4, 'title'=>'Caves of Steel', 'text'=>'Isac Azimov is a must read for evey developer.'],
        ['id'=>5, 'title'=>'Augusto Lindo', 'text'=>'Sua beleza é incomparável.']
    ];

    public static function asArray()
    {
        return static::$data;
    }

    public static function asRelationalArray()
    {
        return static::$relationalData;
    }
}
