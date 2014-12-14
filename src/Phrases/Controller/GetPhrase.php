<?php

namespace Phrases\Controller;

use Zend\Http\Headers;
use Zend\Http\Header\Accept;
use Zend\Http\Request;
use Phrases\Http\Response\CreateResponse;
use Phrases\Http\Response\Type\Json;
use Phrases\Http\Response\Type\PlainText;

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

        return $this->createResponseForCurrentContentType($request, $phrase);
    }

    /**
     * @TODO: Extract method to a Response object builder
     */
    private function createResponseForCurrentContentType(Request $request, $phrase)
    {
        $accept = $request->getHeaders()->get('Accept');
        $jsonResponse = new Json($accept, $phrase);
        $plainTextResponse = new PlainText($accept, $phrase);
        $jsonResponse->setSuccessor($plainTextResponse);

        return $jsonResponse->handlerResponse();
    }
}
