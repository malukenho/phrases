<?php
use Phrases\Application;
use Phrases\Persistance;
use Phrases\Http\Response\Send;

require __DIR__ . '/vendor/autoload.php';

$persistance = new Persistance\Memory(['Jack Makiyama']);
$app = new Application($persistance);
$response = $app->fetchResponse();

Send::response($response);
