<?php

namespace Phrases\Persistance;

require_once 'AbstractRelationalTestCase.php';

use Pdo;

class SQLiteTest extends AbstractRelationalTestCase
{
    protected function createPersistanceAdapter()
    {
        $this->pdo = new Pdo('sqlite::memory:');
        $this->relational = new SQLite($this->pdo);
        $this->relational->createTables();
    }
}

