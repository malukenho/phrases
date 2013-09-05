<?php

error_reporting(-1);
ini_set('display_errors', 1);

date_default_timezone_set('America/Sao_Paulo');

require __DIR__.'/vendor/autoload.php';

$phrasesServer = new Phrases\Server();
$phrasesServer->initiate();