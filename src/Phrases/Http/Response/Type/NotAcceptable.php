<?php

namespace Phrases\Http\Response\Type;

use Zend\Http;
use Phrases\Http\Response\AbstractResponse;

class NotAcceptable extends AbstractResponse
{
    public function serialize(Http\Response $response)
    {
        $response->setStatusCode(406);
        $response->setReasonPhrase('Not acceptable');
        $response->setContent('Wrong type, not acceptable.');

        return $response;
    }

    public function canResolve(Http\Request $request)
    {
        return true;
    }

    public function setSuccessor(AbstractResponse $responseObject)
    {
        $message = 'This handler does not have any successors.';
        throw new \BadMethodCallException($message);
    }
}
