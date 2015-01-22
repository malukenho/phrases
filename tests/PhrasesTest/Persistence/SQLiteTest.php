<?php

namespace Phrases\Persistence;

require_once 'AbstractRelationalTestCase.php';

use Pdo;

class SQLiteTest extends AbstractRelationalTestCase
{
    protected function createPersistenceAdapter()
    {
        $this->pdo = new Pdo('sqlite::memory:');
        $this->relational = new SQLite($this->pdo);
        $this->relational->createTables();
    }
}

