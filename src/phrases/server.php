<?php
namespace Phrases;

class Server
{
	public function initiate()
	{
		$router = Registry::getService('router');
		$router->type($_SERVER['REQUEST_METHOD'])->get('a');
	}
}