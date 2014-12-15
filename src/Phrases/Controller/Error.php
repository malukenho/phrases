<?php

namespace Phrases\Controller;

use Zend\Http;

class Error implements ExecutionInterface
{
    private $statusCode;
    private $statusMessage;

    public function __construct($statusCode, $statusMessage)
    {
        $this->statusMessage = $statusMessage;
        $this->statusCode = $statusCode;
    }
    public function execute(Http\Request $request)
    {
        $response = new Http\Response();
        $response->setStatusCode($this->statusCode);
        $response->setReasonPhrase($this->statusMessage);

        return $response;
    }
}
