<?php

namespace Phrases\Persistence;

use Phrases\Entity\Phrase;

interface RepositoryInterface
{
    public function findOneRandom();
    public function save(Phrase $phrase);
}
