<?php

namespace Phrases\Persistance;

use Phrases\Entity\Phrase;
use PhrasesTestAsset\ConsumedData;

/**
 * @small
 */
class MemoryTest extends \PHPUnit_Framework_TestCase
{
    protected $phraseList = [];

    protected function setUp()
    {
        foreach(ConsumedData::asRelationalArray() as $value){
            $phrase = new Phrase($value['title'], $value['text']);
            array_push($this->phraseList, $phrase);
        }
    }

    public function testFindOneRandomWithAnEmptyListReturnAnEmptyArray()
    {
        $list = [];
        $phrases = new Memory($list);

        $this->assertInstanceOf(
            'Phrases\Persistance\RepositoryInterface',
            $phrases
        );
        $this->assertEquals(
            $expected = [],
            $phrases->findOneRandom()
        );
    }

    public function testFindOneRandomWithOnlyOnePhraseInTheListAlwaysReturnTheSamePhrase()
    {
        $list = [
            $expectedPhrase = $this->phraseList[0]
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
        $list = $this->phraseList;
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
        $phrases = new Memory([$this->phraseList[0]]);
        $newPhrase = $this->phraseList[1];

        $return = $phrases->save($newPhrase);
        $this->assertEquals(
            $newPhrase,
            $return
        );
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Phrase list should contain only Phrase entities.
     */
    public function testMemoryInstantiatedWithArrayOfArraysThrowsAnException()
    {
        $phraseList = [
            ['title' => 'Its a phrase.']
        ];
        $phrases = new Memory($phraseList);
    }
}

