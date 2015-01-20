<?php

namespace Phrases\Persistance;

/**
 * @small
 */
class MemoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFindOneRandomWithAnEmptyListReturnAnEmptyArray()
    {
        $list = array();
        $phrases = new Memory($list);

        $this->assertInstanceOf(
            RepositoryInterface::class,
            $phrases
        );
        $this->assertEquals(
            $expected = array(),
            $phrases->findOneRandom()
        );
    }

    public function testFindOneRandomWithOnlyOnePhraseInTheListAlwaysReturnTheSamePhrase()
    {
        $list = [
            $expectedPhrase = ['title'=>'test', 'text'=>'Something interesting, but not interesting enough.']
        ];
        $phrases = new Memory($list);

        $this->assertEquals(
            $expectedPhrase,
            $phrases->findOneRandom()
        );
        $this->assertEquals(
            $expectedPhrase,
            $phrases->findOneRandom(),
            'Only one phrase is present on the list, so it should be the only "random" option.'
        );
    }

    public function testFindOneRandomWithPhrasesInTheListReturnsFromTheList()
    {
        $list = [
            ['title'=>'test', 'text'=>'Something interesting, but not interesting enough.'],
            ['title'=>'Something', 'text'=>'It is always something.'],
            ['title'=>'Atlas Shrugged', 'text'=>'You should really read this book.'],
            ['title'=>'Caves of Steel', 'text'=>'Isac Azimov is a must read for evey developer.'],
            ['title'=>'Augusto Lindo', 'text'=>'Sua beleza é incomparável.']
        ];
        $phrases = new Memory($list);

        $this->assertContains(
            $firstPhrase = $phrases->findOneRandom(),
            $list
        );

        $this->assertContains(
            $secondPhrase = $phrases->findOneRandom(),
            $list
        );
        $this->assertNotEquals(
            $firstPhrase,
            $secondPhrase,
            'A random algorithm should be working. Maybe it is.'
        );
    }

    /**
     * @depends testFindOneRandomWithOnlyOnePhraseInTheListAlwaysReturnTheSamePhrase
     */
    public function testSaveAppendsPhraseIntoExistingPhraseList()
    {
        $phrases = new Memory(array());
        $newPhrase = ['title'=>'Gugu gostoso', 'text'=>'Pode parecer, mas eu não sou nascisista. Sou realmente gostoso.'];

        $phrases->save($newPhrase);
        $this->assertEquals(
            $newPhrase,
            $phrases->findOneRandom(),
            'Finding one random phrase, when the only one available is the one we saved, should work.'
        );
    }
}
