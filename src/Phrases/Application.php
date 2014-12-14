<?php
namespace Phrases;

use Phrases\Http\Response\Sender;
use Zend\Stdlib\RequestInterface;
use Zend\Http\PhpEnvironment\Request as EnvRequest;
use Zend\Http\Headers;
use Zend\Http\Response;
use Zend\Http\Request;
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
     * @param RequestInterface $request {@see \Zend\Http\Request}
     */
    public function __construct(array $phrases, Request $request = null)
    {
        $this->phrases = $phrases;
        $this->request = is_null($request) ? new EnvRequest() : $request;
    }

    /**
     * Response to a Request
     *
     * @return \Zend\Http\Response
     */
    public function fetchResponse()
    {
        $this->ensureAcceptHeaderExistsOnRequest($this->request);
        $controllerFactory = new Controller\Factory($this->phrases);
        $controller = $controllerFactory->forHttpMethod($this->request);

        return $controller->execute($this->request);
    }

    /**
     * @TODO: Extract method
     */
    private function ensureAcceptHeaderExistsOnRequest(Request $request, $defaultAccept = 'plain/text')
    {
        $currentAccept = $request->getHeaders('Accept');
        if (false === $currentAccept) {
            $defaultAcceptHeaders = Headers::fromString('Accept: '.$defaultAccept);
            $defaultAcceptHeader = $defaultAcceptHeaders->get('Accept');
            $request->getHeaders()->addHeaders($defaultAcceptHeaders);
        }
    }
}
