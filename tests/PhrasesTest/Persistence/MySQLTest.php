<?php

namespace Phrases\Persistence;

require_once 'AbstractRelationalTestCase.php';

use Pdo;

class MySQLTest extends AbstractRelationalTestCase
{
    /**
     * @TODO Remove database provisioning from here.
     * @TODO Move database connection options to environment variables.
     */
    protected function createPersistenceAdapter()
    {
        $username = 'root';
        $password = (getenv('CONTINOUS_INTEGRATION') == 'true') ? '' : 'root';
        $pdo = new Pdo('mysql:host=localhost', $username, $password);
        $pdo->exec('CREATE DATABASE IF NOT EXISTS phrases_test');
        unset($pdo);

        $this->pdo = new Pdo('mysql:host=localhost;dbname=phrases_test', $username, $password);
        $this->relational = new MySQL($this->pdo);
        $this->relational->createTables();
    }
}
