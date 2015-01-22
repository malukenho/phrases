<?php

namespace Phrases\Persistence;

class SQLite extends Relational
{
    /**
     * @return PDOStatement
     */
    protected function createFindOneRandomStatement()
    {
        $sql = 'SELECT id, title, text FROM phrases ORDER BY RANDOM() LIMIT 1';
        $pdo = $this->getPdo();

        return $pdo->prepare($sql);
    }

    /**
     * @return PDOStatement
     */
    protected function createInsertStatement()
    {
        $sql = 'INSERT INTO phrases (title, text) VALUES (:title, :text)';
        $pdo = $this->getPdo();

        return $pdo->prepare($sql);
    }

    /**
     * @return int
     */
    public function createTables()
    {
        $sql ='CREATE TABLE IF NOT EXISTS phrases (
            id INTEGER PRIMARY KEY,
            title TEXT NOT NULL,
            text TEXT NOT NULL
        )';

        return $this->getPdo()->exec($sql);
    }
}
