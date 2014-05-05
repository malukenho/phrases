<?php
namespace Phrases\Router\Http;

use Phrases\Router\Http\Collection;

class Router
{
    private $_routes;

    public function __construct(Collection $collection)
    {
        $this->_routes = $collection;
    }
} 