<?php
namespace Phrases;

use Phrases\Http\Response\Sender;
use Zend\Stdlib\RequestInterface;
use Zend\Http\PhpEnvironment\Request;
use Zend\Http\Headers;
use Zend\Http\Response;
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
        $this->phrases = new Controller\GetPhrase($phrases);
        $this->request = is_null($request) ? new Request() : $request;
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

        if (false === $contentType) {
            $headers = Headers::fromString('Accept: application/json');
            $contentType = $headers->get('Accept');
        }

        switch ($this->request->getMethod()) {
            case 'GET':
                return CreateResponse::to($contentType, $this->phrases->execute());
                break;
            default:
                $message = sprintf('Method %s not expected', $this->request->getMethod());
                $response = new Response();
                $response->setStatusCode(Response::STATUS_CODE_405);
                $response->setContent($message);

                return $response;
        }

    }
}
