<?php
namespace Phrases\Http\Router;

use Phrases\Http;
use RuntimeException;

/**
 * Class Matcher
 *
 * @package Phrases\Http\Router
 */
class Matcher
{

    public function matchCurrentRequest(Http\Router\Collection $collection)
    {
        foreach ($collection->all() as $router) {
            if (preg_match('#'.$router->getRoute().'#', $_SERVER['REQUEST_URI'], $match)) {
                return $match[1];
            }
        }

        throw new RuntimeException('Nenhuma Rota foi encontrada para esse endereço.');
    }
} 