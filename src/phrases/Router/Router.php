<?php
namespace Phrases\Router;

use Phrases\Router\Collection;

class Router
{
    private $_routes;

    public function __construct(Collection $collection)
    {
        $this->_routes = $collection;
    }
} 