<?php

namespace Phrases\Controller;

use Zend\Http\Request;
use Zend\Http\Response;
use Phrases\Entity\Phrase;
use Phrases\Persistence\RepositoryInterface;

class GetPhrase implements ExecutionInterface
{
    /**
     * @var RepositoryInterface
     */
    private $currentPhrases;

    /**
     * Constructor.
     *
     * @param RepositoryInterface $existingPhrases
     */
    public function __construct(RepositoryInterface $existingPhrases)
    {
        $this->currentPhrases = $existingPhrases;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(Request $request)
    {
        $phrase = $this->currentPhrases->findOneRandom();
        $response = new Response;

        if (! $phrase instanceof Phrase) {
            return $response;
        }
        $response->setContent($phrase->getText());

        return $response;
    }
}
