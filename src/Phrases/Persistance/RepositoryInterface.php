<?php

namespace Phrases\Persistance;

interface RepositoryInterface
{
    public function findOneRandom();
    public function save(array $phrase);
}
