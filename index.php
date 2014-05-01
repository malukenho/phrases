<?php
error_reporting(-1);
ini_set('display_errors', 1);

define('BASE_DIR', __DIR__);
date_default_timezone_set('America/Sao_Paulo');

require __DIR__.'/vendor/autoload.php';

$reader = new Phrases\Reader\Xml('phrases.xml');
$settings = new Phrases\Config\SetUp($reader->getConfig());

$routerCollection = new Phrases\Router\Collection();
$routerCollection->add('phrases', new Phrases\Router\Create('/quote/(.+)', array(
    'methods' => 'GET'
)));

$app = new Phrases\Application($routerCollection, $settings);
echo $app->run();