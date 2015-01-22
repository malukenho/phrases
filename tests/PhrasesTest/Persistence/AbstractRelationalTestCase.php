<?php
namespace Phrases\Persistence;

use Pdo;
use Phrases\Entity\Phrase;
use PhrasesTestAsset\ConsumedData;

abstract class AbstractRelationalTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Pdo
     */
    protected $pdo;

    /**
     * @var \Phrases\Persistence\Relational
     */
    protected $relational;
    protected $existingTitles = [];

    protected function setUp()
    {
        $this->createPersistenceAdapter();
        $this->assertNotEmpty($this->pdo, 'Please, set up a pdo instance on the test case.');
        $this->assertNotEmpty($this->relational, 'Please, set up a relational adapter on the test case.');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->relationalProvider = ConsumedData::asRelationalArray();
        $this->relationalEntityPhraseProvider = [];
        foreach(ConsumedData::asRelationalArray() as $value){
            $phrase = new Phrase($value['title'], $value['text']);
            array_push($this->relationalEntityPhraseProvider, $phrase);
            array_push($this->existingTitles, $value['title']);
        }
    }

    abstract protected function createPersistenceAdapter();

    protected function tearDown()
    {
        if ($this->pdo instanceof Pdo) {
            $this->pdo->exec('DROP TABLE phrases');
        }
    }

    private function populatePhrasesTable(array $list)
    {
        $stm = $this->pdo
                    ->prepare('INSERT INTO phrases(title, text) VALUES(:title, :text);');

        $stm->bindValue(':title', $list['title'], Pdo::PARAM_STR);
        $stm->bindValue(':text',  $list['text'],  Pdo::PARAM_STR);

        $stm->execute();
    }

    public function testFindOneRandomWithAnEmptyTableReturnAnEmptyArray()
    {
        $phrases = $this->relational;

        $this->assertInstanceOf(
            RepositoryInterface::class,
            $phrases
        );
        $this->assertEquals(
            $expected = [],
            $phrases->findOneRandom()
        );
    }

    public function testSavePhraseReturnsInsertedId()
    {
        $phrase = new Phrase('New Phrase', 'Hi, I am new!');
        $insertedId = $this->relational->save($phrase);
        $this->assertEquals(
            1,
            $insertedId,
            'Error inserting phrase.'
        );
    }

    /**
     * @depends testSavePhraseReturnsInsertedId
     */
    public function testFindOneRandomWithOnlyOnePhraseInTheTableAlwaysReturnTheSamePhrase()
    {
        $phrase = $this->relationalProvider[0];
        $this->populatePhrasesTable($phrase);

        $phrases = $this->relational;

        $this->assertEquals(
            $phrase['title'],
            $phrases->findOneRandom()->getTitle()
        );
        $this->assertEquals(
            $phrase['text'],
            $phrases->findOneRandom()->getText(),
            'Only one phrase is present on the list, so it should be the only "random" option.'
        );
    }

    /**
     * @depends testSavePhraseReturnsInsertedId
     */
    public function testFindOneRandomWithPhrasesInTheTableReturnsFromTheList()
    {
        $list = $this->relationalProvider;
        $listEntityPhrase = $this->relationalEntityPhraseProvider;

        foreach ($list as $value) {
            $this->populatePhrasesTable($value);
        }

        $phrases = $this->relational;

        $firstPhrase = $phrases->findOneRandom();
        $this->assertInstanceOf(
            Phrase::class,
            $firstPhrase,
            'Every phrase should be a entity'
        );
        $this->assertContains(
            $firstPhrase->getTitle(),
            $this->existingTitles,
            'First phrase should be on the list of phrases in the persistance storage.'
        );

        $secondPhrase = $phrases->findOneRandom();
        $this->assertInstanceOf(
            Phrase::class,
            $secondPhrase,
            'Every phrase should be a entity'
        );
        $this->assertContains(
            $secondPhrase->getTitle(),
            $this->existingTitles,
            'Second phrase should be on the list of phrases in the persistance storage.'
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

        $id = $phrases->save($this->relationalEntityPhraseProvider[0]);
        $this->assertEquals(
            1,
            $id,
            'Return id 1, when the only one available is the one we saved, should work.'
        );
    }
}
