<?php

namespace Phrases\Persistance;

use Phrases\Entity\Phrase;

interface RepositoryInterface
{
    public function findOneRandom();
    public function save(Phrase $phrase);
}
