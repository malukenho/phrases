<?php

namespace Phrases\Persistance;

use PDO;

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
        $onePhrase = $findOneStatement->fetch(PDO::FETCH_ASSOC);
        if (empty($onePhrase)) {
            return [];
        }

        return $onePhrase;
    }

    final public function save(array $phrase)
    {
        $pdo = $this->getPdo();
        $insert = $this->createInsertStatement();
        $insert->bindValue(':title', $phrase['title'], Pdo::PARAM_STR);
        $insert->bindValue(':text',  $phrase['text'],  Pdo::PARAM_STR);
        $insert->execute();

        return (int) $pdo->lastInsertId();
    }
}
