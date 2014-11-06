<?php

use Phrases\Application;

chdir(__DIR__);

require 'vendor/autoload.php';

$phrases = (new Application(['Jack Makiyama']))->run();
