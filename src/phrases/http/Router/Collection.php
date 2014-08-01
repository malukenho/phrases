<?php
namespace Phrases\Http\Router;

use SplObjectStorage;
use Phrases\Http;
use InvalidArgumentException;

class Collection extends SplObjectStorage
{
    /**
     * @param Http\Router $route
     * @param null $inf
     * @throws \InvalidArgumentException
     */
    public function attach($route, $inf = null)
    {
        if (! $route instanceof Http\Router) {
            throw new InvalidArgumentException(
                sprintf('Expect a Phrases\Http\Router instance, %s given.', get_class($route))
            );
        }

        parent::attach($route, $inf);
    }

    /**
     * @param Http\Router $route
     * @throws \InvalidArgumentException
     */
    public function detach($route)
    {
        if (! $route instanceof Http\Router) {
            throw new InvalidArgumentException(
                sprintf('Expect a Phrases\Http\Router instance, %s given.', get_class($route))
            );
        }

        parent::detach($route);
    }

    /**
     * Retrieve all routers stored on current collection
     *
     * @return array
     */
    public function all()
    {
        $routers = array();
        foreach ($this as $route) {
            $routers[] = $route;
        }
        return $routers;
    }
}