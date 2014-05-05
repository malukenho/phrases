<?php
namespace Phrases\Http\Router;

use Iterator;
use Phrases\Http;

class Collection implements Iterator
{
    /**
     * @var array
     */
    private $_routes = array();

    /**
     * @param Http\Router $route
     */
    public function append(Http\Router $route)
    {
        $this->_routes[] = $route;
    }


    public function remove(Http\Router $uri)
    {
        foreach ($this->_routes as $identify => &$route) {
            if ($uri === $route) {
                unset($this->_routes[$identify]);
            }
        }
    }

    public function get($uri)
    {
        return $this->_routes[$uri];
    }

    public function current()
    {
        return current($this->_routes);
    }

    public function next()
    {
        next($this->_routes);
    }

    public function all()
    {
        return $this->_routes;
    }

    public function key()
    {
        return key($this->_routes);
    }

    public function valid()
    {
        if ($this->_routes) {
            return true;
        }
        return false;
    }

    public function rewind()
    {
        reset($this->_routes);
    }
}