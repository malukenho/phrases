<?php
namespace Phrases;

use Phrases\Application\Config\SetUp;
use Phrases\Http;
use Phrases\Reader;

class Application
{
    /**
     * @var Http\Router\Collection
     */
    private $routerCollection;

    /**
     * @var Reader\IReader
     */
    private $settings;

    /**
     * @var Http\Router\Matcher
     */
    private $match;

    /**
     * @param Http\Router\Collection $collection
     * @param Reader\IReader $settings
     * @param Http\Router\Matcher $matcher
     */
    public function __construct(Http\Router\Collection $collection, Reader\IReader $settings, Http\Router\Matcher $matcher)
    {
        $this->routerCollection = $collection;
        $this->settings = $settings;
        $this->match = $matcher;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $entity = $this->match->matchCurrentRequest($this->routerCollection);
        return $this->settings->findBy($entity);
    }

} 