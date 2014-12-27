<?php

namespace Phrases\Persistance;

class MySQL extends SQLite
{
    public function createTables()
    {
        $sql ='CREATE TABLE IF NOT EXISTS phrases (
            id INTEGER(11) PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL UNIQUE,
            text TEXT NOT NULL
        ) Engine=InnoDB';

        return $this->getPdo()->exec($sql);
    }

    protected function createFindOneRandomStatement()
    {
        $sql = 'SELECT id, title, text FROM phrases ORDER BY RAND() LIMIT 1';
        $pdo = $this->getPdo();

        return $pdo->prepare($sql);
    }
}
