<?php
namespace Phrases;

use Phrases\Http\Response\Sender;
use Zend\Stdlib\RequestInterface;
use Zend\Http\PhpEnvironment\Request;
use Phrases\Http\Response\CreateResponse;

class Application
{
    /**
     * @var array
     */
    private $phrases;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * Constructor.
     *
     * @param string[]         $phrases
     * @param RequestInterface $request {@see \Zend\Stdlib\RequestInterface}
     */
    public function __construct(array $phrases, RequestInterface $request = null)
    {
        $this->phrases = $phrases;
        $this->request = is_null($request) ? new Request() : $request;
    }

    /**
     * Return all Phrase
     *
     * @return string[]
     */
    public function getPhrases()
    {
        return $this->phrases;
    }

    /**
     * Return the single first phrase
     *
     * @return string
     */
    public function getPhrase()
    {
        return current($this->phrases);
    }

    /**
     * Response to a Request
     *
     * @return \Zend\Http\Response
     */
    public function fetchResponse()
    {
        $contentType = $this
            ->request
                ->getHeaders()
                ->get('Accept');

        return CreateResponse::to($contentType, $this->getPhrase());
    }
}
