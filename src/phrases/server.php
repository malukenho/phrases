<?php
namespace Phrases;

class Server
{
    public function initiate()
    {
        $router = new Services\Router;
        $router->httpMethodTypeRequested($_SERVER['REQUEST_METHOD'])
               ->setUri($_SERVER['REQUEST_URI']);
    }
}