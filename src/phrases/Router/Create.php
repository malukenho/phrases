<?php
namespace Phrases\Router;

class Create
{
    protected $uri;
    protected $config;

    public function __construct($uri, array $config)
    {
        $this->uri = $uri;
        $this->config = $config;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getConfig()
    {
        return $this->config;
    }
}