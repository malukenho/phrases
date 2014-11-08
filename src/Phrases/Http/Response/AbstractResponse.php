<?php
namespace Phrases\Http\Response;

use Zend\Http\Response;
use Zend\Http\Header\Accept;

/**
 * Response a request based on your Accept header.
 *
 * @author Jefersson Nathan <malukenho@phpse.net>
 */
abstract class AbstractResponse
{
    /**
     * @var Accept
     */
    protected $accept;

    /**
     * @var string
     */
    protected $phrase;

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
            return $this->objectSuccessor->tryResponseType();
        }
    }

    /**
     * Set a successor to be called if the current object can't
     * response the request.
     *
     * @param AbstractResponse $responseObject
     */
    final public function setSuccessor(AbstractResponse $responseObject)
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
     * Check if an object has a sucessor
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
     * @return mixed
     */
    public function tryResponseType()
    {
        if (! $this->isHandled && $this->canResolve()) {
            $this->markRequestAsHandled();
            return $this->response();
        }

        return $this->callSuccessor();
    }

    /**
     * Create and return an object of can Response this request.
     *
     * Code example:
     *
     * <code>
     *      $response = new Response();
     *      $response->setStatusCode(Response::STATUS_CODE_200);
     *      $response->setContent($this->phrase);
     *      $response->getHeaders()->addHeaders([
     *          'Content-Type' => 'text/plain'
     *      ]);
     *
     *      return $response;
     * </code>
     *
     * @return Response
     */
    abstract public function response();

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
     * @return boolean
     */
    abstract public function canResolve();
}
