<?php
namespace Phrases\Http\Router;

use Phrases\Http\Router\Collection;
use Phrases\Http\Request;
use RuntimeException;

class Matcher
{
    private $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function routers()
    {
        foreach ($this->collection->all() as $router) {
            if (preg_match('#'.$router->getUri().'#', $_SERVER['REQUEST_URI'], $match)) {
                return $match[1];
            }
        }

        throw new RuntimeException('Nenhuma Rota foi encontrada para esse endereço.');
    }
} 