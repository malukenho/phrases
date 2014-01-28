<?php
namespace Phrases;

use Phrases\Services\Router;

class Server
{
	private $_router;

	public function __construct(Router $router)
	{
		$this->_router = $router;
	}

	public function dispatch()
	{
		return $this->_router->delegateRequest();
	}
}