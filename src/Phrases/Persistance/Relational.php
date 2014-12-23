<?php

namespace Phrases\Persistance;

use \Pdo;

class Relational implements RepositoryInterface
{
    /**
     * @var \Pdo
     */
    protected $pdo;

    public function __construct(Pdo $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findOneRandom()
    {
        $list = $this->getAll();

        if (empty($list)) {
            return $list;
        }

        shuffle($list);

        return $list[0];
    }

    private function getAll()
    {
        $stm = $this->pdo
                    ->prepare('SELECT id, title, text FROM phrases;');

        $stm->execute();

        return $stm->fetchAll(Pdo::FETCH_ASSOC);
    }

    public function save(array $phrase)
    {
        $stm = $this->pdo
                    ->prepare('INSERT INTO phrases(title, text) VALUES(:title, :text);');

        $stm->bindValue(':title', $phrase['title'], Pdo::PARAM_STR);
        $stm->bindValue(':text',  $phrase['text'],  Pdo::PARAM_STR);

        $stm->execute();

        return (int) $this->pdo->lastInsertId();
    }
}
