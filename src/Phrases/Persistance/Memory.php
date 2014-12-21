<?php

namespace Phrases\Persistance;

class Memory implements RepositoryInterface
{
    protected $list = array();

    public function __construct(array $list)
    {
        $this->list = $list;
    }

    public function findOneRandom()
    {
        if (empty($this->list)) {
            return array();
        }

        $keys = array_keys($this->list);
        $min = 0;
        $max = count($keys)-1;
        $random = mt_rand($min, $max);

        return $this->list[$random];
    }

    public function save(array $phrase)
    {
        $this->list[] = $phrase;
    }
}
