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
     * @param array            $phrases
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
     * @return array
     */
    public function getPhrases()
    {
        return $this->phrases;
    }

    /**
     * Return the single first phrase
     *
     * @return mixed
     */
    public function getPhrase()
    {
        return current($this->phrases);
    }

    /**
     * Response to a Request
     *
     * @return void
     */
    public function run()
    {
        $contentType = $this
            ->request
                ->getHeaders()
                ->get('Accept');

        $response = CreateResponse::to($contentType, $this->getPhrase());

        $sender = new Sender();
        $sender->send($response);
    }
}
