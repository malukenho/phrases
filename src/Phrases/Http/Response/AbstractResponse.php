<?php

namespace Phrases\Http\Response;

use Zend\Http\Response;
use Zend\Http\Request;
use Zend\Http\Header\Accept;

/**
 * Response a request based on your Accept header.
 *
 * @author Jefersson Nathan <malukenho@phpse.net>
 */
abstract class AbstractResponse
{
    /**
     * @var self
     */
    private $objectSuccessor;

    /**
     * Know if a request has ben responded.
     *
     * @var bool
     */
    private $isHandled = false;

    /**
     * Try to call a successor if has been setted.
     *
     * @param Request  $request
     * @param Response $response
     *
     * @return void|mixed
     */
    private function callSuccessor(Request $request, Response $response)
    {
        if ($this->hasSuccessor()) {
            return $this->objectSuccessor->handlerResponse($request, $response);
        }
    }

    /**
     * Set a successor to be called if the current object can't
     * response the request.
     *
     * @param AbstractResponse $responseObject
     */
    public function setSuccessor(AbstractResponse $responseObject)
    {
        $this->objectSuccessor = $responseObject;
    }

    /**
     * Mark a request as responded.
     *
     * @return void
     */
    final public function markRequestAsHandled()
    {
        $this->isHandled = true;
    }

    /**
     * Check if an object has a successor.
     *
     * @return boolean
     */
    final public function hasSuccessor()
    {
        return $this->objectSuccessor ? true : false;
    }

    /**
     * Try response a Request, If not possible call another object
     * of can do it.
     *
     * @param Request  $request
     * @param Response $response
     *
     * @return \Zend\Http\Response
     */
    final public function handlerResponse(Request $request, Response $response)
    {
        if ($this->isHandled) {
            return $response;
        }

        if (! $this->canResolve($request)) {
            $this->markRequestAsHandled();
            return $this->serialize($response);
        }

        return $this->callSuccessor($request, $response);
    }

    /**
     * Create and return an object of can Response this request.
     *
     * Code example:
     * <code>
     *      $contentToSerialize = $response->getContent();
     *      $response->getHeaders()->addHeaders([
     *          'Content-Type' => 'application/json'
     *      ]);
     *      $response->setContent(json_encode($contentToSerialize));
     *
     *      return $response;
     * </code>
     *
     * @param Response $response
     *
     * @return \Zend\Http\Response
     */
    abstract public function serialize(Response $response);

    /**
     * Need to return a boolean value if request can be resolved by
     * current implementation or not.
     *
     * Here's a simple code example:
     *
     * <code>
     *      return $this->accept->hasMediaType('json');
     * </code>
     *
     * @param Request $request
     *
     * @return boolean
     */
    abstract public function canResolve(Request $request);
}
