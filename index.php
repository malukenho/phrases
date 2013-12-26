<?php

error_reporting(-1);
ini_set('display_errors', 1);

define('BASE_DIR', __DIR__);

date_default_timezone_set('America/Sao_Paulo');

require __DIR__.'/vendor/autoload.php';

$phrasesServer = new Phrases\Server();

echo $phrasesServer->initiate('phrases.xml')
    ->uri('/quote/*')
    ->dispatch();