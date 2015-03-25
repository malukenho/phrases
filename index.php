<?php
use Phrases\Application;
use Phrases\Command\CommandBus;
use Phrases\Command\PostCommandHandler;
use Phrases\Persistence;
use Phrases\Entity\Phrase;
use Phrases\Http\Response\Send;

require __DIR__ . '/vendor/autoload.php';

$commandBus = new CommandBus([new PostCommandHandler()]);

$phrase = new Phrase(
    'Lorem ipsum',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.'
);

$app = new Application(new Persistence\Memory([$phrase], $commandBus));
$response = $app->fetchResponse();

Send::response($response);
