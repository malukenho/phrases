<?php

namespace Phrases\Controller;

use Zend\Http\Request;
use Zend\Http\Response;
use Phrases\Persistance\RepositoryInterface;

class GetPhrase implements ExecutionInterface
{
    private $currentPhrases;

    public function __construct(RepositoryInterface $existingPhrases)
    {
        $this->currentPhrases = $existingPhrases;
    }

    public function execute(Request $request)
    {
        $phrase = $this->currentPhrases->findOneRandom();
        $response = new Response;
        $response->setContent($phrase->getText());

        return $response;
    }
}
