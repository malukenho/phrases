<?php
namespace PhrasesTest;

<<<<<<< HEAD
use Pdo;
use Zend\Http\Request;
use Zend\Http\Headers;
use Phrases\Application;
use Phrases\Entity\Phrase;
use Zend\StdLib\Parameters;
use Phrases\Persistence\MySQL;
use PHPUnit_Framework_TestCase;
use PhrasesTestAsset\ConsumedData;

/**
 * @huge
 */
=======
use Phrases\Application;
use PHPUnit_Framework_TestCase;
use PhrasesTestAsset\ConsumedData;

>>>>>>> master
class ApplicationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Application
     */
    private $application;
<<<<<<< HEAD
    /**
     * @var \PDO
     */
    private $pdo;
    private $persistence;

    public function setUp()
    {
        $username = 'root';
        $password = (getenv('CONTINUOUS_INTEGRATION') == 'true') ? '' : 'root';
        $pdo = new Pdo('mysql:host=localhost', $username, $password);
        $pdo->exec('CREATE DATABASE IF NOT EXISTS phrases_test');
        unset($pdo);

        $this->pdo = new Pdo('mysql:host=localhost;dbname=phrases_test', $username, $password);
        $sql = 'CREATE TABLE IF NOT EXISTS phrases (
            id INTEGER(11) PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL UNIQUE,
            text TEXT NOT NULL
        ) Engine=InnoDB';

        $this->pdo->exec($sql);
        $this->populatePhrasesTable($this->pdo, ConsumedData::asRelationalArray()[0]);

        $this->persistence = new MySQL($this->pdo);
        $this->application = new Application($this->persistence);
    }

    public function tearDown()
    {
        $this->pdo
            ->exec('DELETE FROM phrases');
    }

    private function populatePhrasesTable(Pdo $pdo, array $list)
    {
        $stm = $pdo
            ->prepare('INSERT INTO phrases(title, text) VALUES(:title, :text);');

        $stm->bindValue(':title', $list['title'], Pdo::PARAM_STR);
        $stm->bindValue(':text',  $list['text'],  Pdo::PARAM_STR);

        $stm->execute();
    }

    public function testGetPhraseAsPlainText()
    {
        $request = new Request;
        $request->setMethod('GET');
        $request->setUri('http://localhost/');
        $request->setHeaders(Headers::fromString('Accept: plain/text'));
        $app = new Application($this->persistence, $request);
        $response = $app->fetchResponse();
        $this->assertInstanceOf(
            'Zend\Http\Response',
            $response
        );
        $this->assertEquals(
            200,
            $response->getStatusCode()
        );
        $expectedPhrase = '"Something interesting, but not interesting enough."';
        $this->assertEquals(
            $expectedPhrase,
            $response->getBody()
        );
    }

    public function testPostNewPhrase()
    {
        $request = new Request;
        $parameters = new Parameters([
            'title' => 'É nóis que voa bruxão',
            'text'  => 'hehe'
        ]);
        $request->setMethod('POST');
        $request->setUri('http://localhost/');
        $request->setPost($parameters);
        $app = new Application($this->persistence, $request);
        $response = $app->fetchResponse();
        $this->assertInstanceOf(
            'Zend\Http\Response',
            $response
        );
        $this->assertEquals(
            201,
            $response->getStatusCode()
        );
        $expectedUrlPath = '/e-nois-que-voa-bruxao';
        $this->assertContains(
            $expectedUrlPath,
            $response->getBody(),
            'Expected URL of created Phrase'
        );
=======

    public function setUp()
    {
        $this->application = new Application(ConsumedData::asArray());
    }

    public function testApplicationCanStorageThePhrases()
    {
        $this->assertEquals(ConsumedData::asArray(), $this->application->getPhrases());
    }

    public function testApplicationReturnOnePhrase()
    {
        $phrase = $this->application->getPhrase();
        $consumedData = ConsumedData::asArray();

        $this->assertEquals($consumedData[0], $phrase);
>>>>>>> master
    }
}
