<?php
namespace Phrases\Http;

class Router
{
    private $_method;
    private $_route;

    public function __construct($method, $pattern)
    {
        $this->_method = $method;
        $this->_route = $pattern;
    }

    public function getRoute()
    {
        return $this->_route;
    }

    public function getMethod()
    {
        return $this->_method;
    }
} 