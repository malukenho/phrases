<?php
namespace Phrases\Services;

class Router
{
	private $_routerCollection = array();
	private $_routerClass;

	public function __construct(array $urlRouters)
	{
		$this->_routerCollection = $urlRouters;
		$this->_matchRequest();
	}

	private function _matchRequest()
	{
		ksort($this->_routerCollection);

		foreach ($this->_routerCollection as $regex => $className) {
			$regex = str_replace('/', '\/', $regex);
			$regex = '/'. $regex . '/';

			if ($this->_match($regex, $className)) {
				break 1;
			}
		}
	}

	private function _match($regex, $className)
	{
		preg_match($regex, $this->_getPath(), $matches);

		if (! $matches) {
			return false;
		}
		
		$className = __NAMESPACE__.'\\Response\\'.$className;

		if (! class_exists($className)) {
			throw new Exception('Class '.$className. ' not found!');
			return false;
		}

		$routerClass = new $className;

		if (! method_exists($routerClass, $this->_getHttpContext())) {
			throw new BadMethodCallException('Method '.$this->_getHttpContext() .', no suported!');
			return false;
		}

		$this->_routerClass = $routerClass;
		return true;
	}


	private function _getHost()
	{
		return $_SERVER['HTTP_HOST'];
	}

	private function _getPath()
	{
		return $_SERVER['REQUEST_URI'];
	}

	private function _getHttpContext()
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	public function delegateRequest()
	{
		return call_user_func(
			array($this->_routerClass, $this->_getHttpContext())
		);
	}
}