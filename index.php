<?php
use Phrases\Application;
use Phrases\Persistence;
use Phrases\Entity\Phrase;
use Phrases\Http\Response\Send;

require __DIR__ . '/vendor/autoload.php';

$phrase = new Phrase(
    'Lorem ipsum',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.'
);

$persistance = new Persistence\Memory([$phrase]);

$app = new Application($persistance);
$response = $app->fetchResponse();

Send::response($response);
