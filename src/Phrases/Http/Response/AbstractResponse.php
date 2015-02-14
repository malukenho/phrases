<?php
<<<<<<< HEAD

namespace Phrases\Http\Response;

use Zend\Http\Response;
use Zend\Http\Request;
=======
namespace Phrases\Http\Response;

use Zend\Http\Response;
>>>>>>> master
use Zend\Http\Header\Accept;

/**
 * Response a request based on your Accept header.
 *
 * @author Jefersson Nathan <malukenho@phpse.net>
 */
abstract class AbstractResponse
{
    /**
<<<<<<< HEAD
=======
     * @var Accept
     */
    protected $accept;

    /**
     * @var string
     */
    protected $phrase;

    /**
>>>>>>> master
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
<<<<<<< HEAD
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
=======
     * Constructor.
     *
     * @param Accept $accept
     * @param string $phrase Data to show on response
     */
    public function __construct(Accept $accept, $phrase)
    {
        $this->accept = $accept;
        $this->phrase = $phrase;
    }

    /**
     * Try to call a successor if has been setted.
     *
     * @return void|mixed
     */
    private function callSuccessor()
    {
        if ($this->hasSuccessor()) {
            return $this->objectSuccessor->handlerResponse();
>>>>>>> master
        }
    }

    /**
     * Set a successor to be called if the current object can't
     * response the request.
     *
     * @param AbstractResponse $responseObject
     */
<<<<<<< HEAD
    public function setSuccessor(AbstractResponse $responseObject)
=======
    final public function setSuccessor(AbstractResponse $responseObject)
>>>>>>> master
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
<<<<<<< HEAD
     * Check if an object has a successor.
=======
     * Check if an object has a sucessor
>>>>>>> master
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
<<<<<<< HEAD
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
=======
     * @return mixed
     */
    public function handlerResponse()
    {
        if (! $this->isHandled && $this->canResolve()) {
            $this->markRequestAsHandled();
            return $this->response();
        }

        return $this->callSuccessor();
>>>>>>> master
    }

    /**
     * Create and return an object of can Response this request.
     *
     * Code example:
<<<<<<< HEAD
     * <code>
     *      $contentToSerialize = $response->getContent();
     *      $response->getHeaders()->addHeaders([
     *          'Content-Type' => 'application/json'
     *      ]);
     *      $response->setContent(json_encode($contentToSerialize));
=======
     *
     * <code>
     *      $response = new Response();
     *      $response->setStatusCode(Response::STATUS_CODE_200);
     *      $response->setContent($this->phrase);
     *      $response->getHeaders()->addHeaders([
     *          'Content-Type' => 'text/plain'
     *      ]);
>>>>>>> master
     *
     *      return $response;
     * </code>
     *
<<<<<<< HEAD
     * @param Response $response
     *
     * @return \Zend\Http\Response
     */
    abstract public function serialize(Response $response);
=======
     * @return Response
     */
    abstract public function response();
>>>>>>> master

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
<<<<<<< HEAD
     * @param Request $request
     *
     * @return boolean
     */
    abstract public function canResolve(Request $request);
=======
     * @return boolean
     */
    abstract public function canResolve();
>>>>>>> master
}
