<?php

namespace Phrases\Persistence;

use PDO;
use Phrases\Entity\Phrase;

abstract class Relational implements RepositoryInterface
{
    /**
     * @var PDO
     */
    private $pdoInstance;
    /**
     * @return PDOStatement
     */
    abstract protected function createFindOneRandomStatement();
    /**
     * @return PDOStatement
     */
    abstract protected function createInsertStatement();
    /**
     * @return boolean
     */
    abstract public function createTables();

    public function __construct(PDO $pdoInstance)
    {
        $this->pdoInstance = $pdoInstance;
    }

    /**
     * @return PDO
     */
    protected function getPdo()
    {
        return $this->pdoInstance;
    }

    final public function findOneRandom()
    {
        $findOneStatement = $this->createFindOneRandomStatement();
        $findOneStatement->execute();
        $findOneStatement->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Phrase::class, ['temp_title', 'temp_text']);
        $onePhrase = $findOneStatement->fetch();
        if (empty($onePhrase)) {
            return [];
        }

        return $onePhrase;
    }

    final public function save(Phrase $phrase)
    {
        $pdo = $this->getPdo();
        $insert = $this->createInsertStatement();
        $insert->bindValue(':title', $phrase->getTitle(), Pdo::PARAM_STR);
        $insert->bindValue(':text',  $phrase->getText(),  Pdo::PARAM_STR);
        $insert->execute();

        return (int) $pdo->lastInsertId();
    }
}

