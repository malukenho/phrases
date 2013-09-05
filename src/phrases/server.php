<?php
namespace Phrases;

class Server
{
	public function initiate()
	{
		$router = new Services\Router;
		$router->type($_SERVER['REQUEST_METHOD'])->get('a');
	}
}