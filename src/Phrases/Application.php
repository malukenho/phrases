<?php

namespace Phrases;

use Phrases\Command\CommandBus;
use Phrases\Http\Response\Type;
use Phrases\Persistence\RepositoryInterface;
use Zend\Stdlib\RequestInterface;
use Zend\Http\PhpEnvironment\Request as EnvRequest;
use Zend\Http\Headers;
use Zend\Http\Response;
use Zend\Http\Request;

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
     * @var CommandBus
     */
    private $commandBus;

    /**
     * Constructor.
     *
     * @param RepositoryInterface      $phrases
     * @param CommandBus               $commandBus
     * @param Request|RequestInterface $request {@see \Zend\Http\Request}
     */
    public function __construct(RepositoryInterface $phrases, CommandBus $commandBus, Request $request = null)
    {
        $this->phrases    = $phrases;
        $this->commandBus = $commandBus;
        $this->request    = null === $request ? new EnvRequest() : $request;
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
        $controller = $controllerFactory->forHttpMethod($this->request, $this->commandBus);
        $response = $controller->execute($this->request);

        return $this->serializeControllerResponse($this->request, $response);
    }

    /**
     * @TODO: Extract method
     *
     * @param Request $request
     * @param string  $defaultAccept
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
     *
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    private function serializeControllerResponse(Request $request, Response $response)
    {
        $json = new Type\Json;
        $html = new Type\Html;
        $text = new Type\PlainText;
        $notAcceptable = new Type\NotAcceptable;
        $json->setSuccessor($html);
        $html->setSuccessor($text);
        $text->setSuccessor($notAcceptable);

        return $json->handlerResponse($request, $response);
    }
}
