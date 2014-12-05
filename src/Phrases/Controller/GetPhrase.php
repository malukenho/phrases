<?php

namespace Phrases\Controller;

class GetPhrase
{
    private $currentPhrases;

    public function __construct(array $existingPhrases)
    {
        $this->currentPhrases = $existingPhrases;
    }

    public function execute()
    {
        return array_shift($this->currentPhrases);
    }
}
