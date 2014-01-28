<?php

error_reporting(-1);
ini_set('display_errors', 1);

define('BASE_DIR', __DIR__);

date_default_timezone_set('America/Sao_Paulo');

require __DIR__.'/vendor/autoload.php';

$router = new Phrases\Services\Router(
	array(
		'quote/(.+)' => 'Quote'
	)
);

$phrasesServer = new Phrases\Server($router);
echo $phrasesServer->dispatch();