<?php

namespace Phrases\Http\Response\Type;

use Zend\Http;
use Phrases\Http\Response\AbstractResponse;

class NotAcceptable extends AbstractResponse
{
    /**
     * @param Http\Response $response
     *
     * @return Http\Response
     */
    public function serialize(Http\Response $response)
    {
        $response->setStatusCode(Http\Response::STATUS_CODE_406);
        $response->setReasonPhrase('Not acceptable');

        return $response;
    }

    /**
     * @param Http\Request $request
     *
     * @return bool
     */
    public function canResolve(Http\Request $request)
    {
        return true;
    }

    /**
     * @param AbstractResponse $responseObject
     */
    public function setSuccessor(AbstractResponse $responseObject)
    {
        $message = 'This handler does not have any successors.';
        throw new \BadMethodCallException($message);
    }
}
