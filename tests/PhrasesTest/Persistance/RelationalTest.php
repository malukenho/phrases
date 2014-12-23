<?php
namespace Phrases\Persistance;

use \Pdo;
use PhrasesTestAsset\ConsumedData;

class RelationalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pdo
     */
    protected $pdo;

    /**
     * @var \Phrases\Persistance\Relational
     */
    protected $relational;

    protected function setUp()
    {
        $this->pdo = new Pdo('sqlite::memory:');
        $this->pdo
             ->exec('
                 CREATE TABLE phrases (
                     id INTEGER PRIMARY KEY,
                     title TEXT NOT NULL,
                     text TEXT NOT NULL
                 );
             ');
        $this->relational = new Relational($this->pdo);
        $this->relationalProvider = ConsumedData::asRelationalArray();
    }

    protected function tearDown()
    {
        $this->pdo
             ->exec('DROP TABLE phrases');
    }

    private function populatePhrasesTable(array $list)
    {
        $stm = $this->pdo
                    ->prepare('INSERT INTO phrases(id, title, text) VALUES(:id, :title, :text);');

        $stm->bindValue(':id',    $list['id'],    Pdo::PARAM_INT);
        $stm->bindValue(':title', $list['title'], Pdo::PARAM_STR);
        $stm->bindValue(':text',  $list['text'],  Pdo::PARAM_STR);

        $stm->execute();
    }

    public function testFindOneRandomWithAnEmptyTableReturnAnEmptyArray()
    {
        $phrases = $this->relational;

        $this->assertInstanceOf(
            'Phrases\Persistance\RepositoryInterface',
            $phrases
        );
        $this->assertEquals(
            $expected = array(),
            $phrases->findOneRandom()
        );
    }

    public function testFindOneRandomWithOnlyOnePhraseInTheTableAlwaysReturnTheSamePhrase()
    {
        $expectedPhrase = $this->relationalProvider[0];
        $this->populatePhrasesTable($expectedPhrase);

        $phrases = $this->relational;

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

    public function testFindOneRandomWithPhrasesInTheTableReturnsFromTheList()
    {
        $list = $this->relationalProvider;

        foreach ($list as $value) {
            $this->populatePhrasesTable($value);
        }

        $phrases = $this->relational;

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
     * @depends testFindOneRandomWithOnlyOnePhraseInTheTableAlwaysReturnTheSamePhrase
     */
    public function testSaveAppendsPhraseIntoExistingPhraseList()
    {
        $phrases = $this->relational;

        $id = $phrases->save($this->relationalProvider[0]);
        $this->assertEquals(
            1,
            $id,
            'Return id 1, when the only one available is the one we saved, should work.'
        );
    }
}

