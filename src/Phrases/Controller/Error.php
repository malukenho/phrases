<?php

namespace Phrases\Controller;

use Zend\Http;

class Error implements ExecutionInterface
{
    /**
     * @var integer represents a http status code
     */
    private $statusCode;

    /**
     * @var string represents a message of http response
     */
    private $statusMessage;

    /**
     * Constructor.
     *
     * @param integer $statusCode
     * @param string  $statusMessage
     */
    public function __construct($statusCode, $statusMessage)
    {
        $this->statusMessage = $statusMessage;
        $this->statusCode = $statusCode;
    }

    /**
     * @param Http\Request $request
     *
     * @return Zend\Http\Response|Http\Response
     */
    public function execute(Http\Request $request)
    {
        $response = new Http\Response();
        $response->setStatusCode($this->statusCode);
        $response->setReasonPhrase($this->statusMessage);

        return $response;
    }
}
