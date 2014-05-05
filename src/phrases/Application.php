<?php
namespace Phrases;

use Phrases\Application\Config\SetUp;
use Phrases\Http\Router\Collection;
use Phrases\Http\Router\Matcher;

class Application
{
    /**
     * @var Http\Router\Collection
     */
    private $routerCollection;

    /**
     * @var Config\SetUp
     */
    private $settings;

    /**
     * Proxy pattern
     */
    private $matchInstance = null;

    /**
     * @param Collection $collection of routers
     * @param SetUp      $settings   for application
     */
    public function __construct(Collection $collection, SetUp $settings)
    {
        $this->routerCollection = $collection;
        $this->settings = $settings;
    }

    /**
     * Run task with settings
     *
     * @return string
     */
    public function run()
    {
        if (null === $this->matchInstance) {
            $this->matchInstance = new Matcher($this->routerCollection);
        }

        $entity = $this->matchInstance->routers();
        $reader = $this->settings->getReaderConfig();

        return $reader->findBy($entity);
    }

} 