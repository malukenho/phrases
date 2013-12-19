<?php
namespace Phrases;

class Server
{
    public function initiate($fileToConsult)
    {
        $router = new Services\Router;
        return $router->setUri($_SERVER['REQUEST_URI'])
        	->fileToConsult($fileToConsult)
        	->httpMethodTypeRequested($_SERVER['REQUEST_METHOD']);
    }
}