<?php
namespace Phrases\Router;

use Iterator;
use Phrases\Router\Create;

class Collection implements Iterator
{
    private $_routes = array();

    public function add($uri, Create $action)
    {
        $this->_routes[$uri] = $action;
    }

    public function remove($uri)
    {
        unset($this->_routes[$uri]);
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