<?php
use Phrases\Application;
use Phrases\Http\Response\Send;

require __DIR__ . '/vendor/autoload.php';

$app = new Application(['Jack Makiyama']);
$response = $app->fetchResponse();

Send::response($response);
