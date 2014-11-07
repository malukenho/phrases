<?php
use Phrases\Application;

require __DIR__ . '/vendor/autoload.php';

$app = new Application(['Jack Makiyama']);
$app->run();
