<?php
error_reporting(-1);
ini_set('display_errors', 1);

define('BASE_DIR', __DIR__);
date_default_timezone_set('America/Sao_Paulo');

require __DIR__.'/vendor/autoload.php';

$readerFactory = new Phrases\Reader\Configuration\Factory;
$settings = $readerFactory->createXmlConfigurationForFileName('phrases.xml');

$routePhrases = new Phrases\Http\Router('GET', '/quote/(.+)');

$routerCollection = new Phrases\Http\Router\Collection();
$routerCollection->attach($routePhrases);

$matcher = new Phrases\Http\Router\Matcher;

$app = new Phrases\Application($routerCollection, $settings, $matcher);
echo $app->run();