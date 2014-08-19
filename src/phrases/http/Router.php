<?php
namespace Phrases\Http;

class Router
{
    private $_method;
    private $_route;

    /**
     * @param $method
     * @param $pattern
     */
    public function __construct($method, $pattern)
    {
        $this->_method = $method;
        $this->_route = $pattern;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->_route;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->_method;
    }
} 