<?php
namespace Phrases;

use Phrases\Http\Response\Sender;
use Phrases\Http\Response\Type;
use Zend\Stdlib\RequestInterface;
use Zend\Http\PhpEnvironment\Request as EnvRequest;
use Zend\Http\Headers;
use Zend\Http\Response;
use Zend\Http\Request;
use Phrases\Http\Response\CreateResponse;
use Phrases\Persistance;

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
    public function __construct(Persistance\RepositoryInterface $phrases, Request $request = null)
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
        $response = $controller->execute($this->request);

        return $this->serializeControllerResponse($this->request, $response);
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

    /**
     * @TODO: Extract method.
     */
    private function serializeControllerResponse(Request $request, Response $response)
    {
        $json = new Type\Json;
        $text = new Type\PlainText;
        $notAcceptable = new Type\NotAcceptable;
        $json->setSuccessor($text);
        $text->setSuccessor($notAcceptable);

        return $json->handlerResponse($request, $response);
    }
}
