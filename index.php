<?php
use Phrases\Application;
use Phrases\Persistence;
use Phrases\Http\Response\Send;

require __DIR__ . '/vendor/autoload.php';

$persistance = new Persistence\Memory(['Jack Makiyama']);
$app = new Application($persistance);
$response = $app->fetchResponse();

Send::response($response);
