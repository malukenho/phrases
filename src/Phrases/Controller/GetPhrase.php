<?php

namespace Phrases\Controller;

use Zend\Http\Request;
use Zend\Http\Response;

class GetPhrase implements ExecutionInterface
{
    private $currentPhrases;

    public function __construct(array $existingPhrases)
    {
        $this->currentPhrases = $existingPhrases;
    }

    public function execute(Request $request)
    {
        $phrase = array_shift($this->currentPhrases);
        $response = new Response;
        $response->setContent($phrase);

        return $response;
    }
}
