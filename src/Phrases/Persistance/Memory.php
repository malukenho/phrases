<?php

namespace Phrases\Persistance;

use Phrases\Entity\Phrase;

class Memory implements RepositoryInterface
{
    protected $list = [];

    public function __construct(array $list)
    {
        foreach ($list as $phrase) {
            if ($phrase instanceof Phrase) {
                continue;
            }

            $message = 'Phrase list should contain only Phrase entities.';
            throw new \InvalidArgumentException($message);
        }
        $this->list = $list;
    }

    public function findOneRandom()
    {
        if (empty($this->list)) {
            return [];
        }

        $keys = array_keys($this->list);
        $min = 0;
        $max = count($keys)-1;
        $random = mt_rand($min, $max);

        return $this->list[$random];
    }

    public function save(Phrase $phrase)
    {
        return $this->list[] = $phrase;
    }
}

