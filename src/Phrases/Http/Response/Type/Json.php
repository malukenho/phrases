<?php
namespace Phrases\Http\Response\Type;

<<<<<<< HEAD
use Zend\Http;
=======
use Zend\Http\Response;
>>>>>>> master
use Phrases\Http\Response\AbstractResponse;

/**
 * Response a request does accept Json representation
 *
 * @author Jefersson Nathan <malukenho@phpse.net>
 */
class Json extends AbstractResponse
{
    /**
     * {@inheritDoc}
     */
<<<<<<< HEAD
    public function serialize(Http\Response $response)
    {
        $content = $response->getContent();
        $response->setContent(json_encode($content));
=======
    public function response()
    {
        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->setContent(json_encode([$this->phrase]));
>>>>>>> master
        $response->getHeaders()->addHeaders([
            'Content-Type' => 'application/json'
        ]);

        return $response;
    }

    /**
     * {@inheritDoc}
     */
<<<<<<< HEAD
    public function canResolve(Http\Request $request)
    {
        $accept = $request->getHeaders()->get('Accept');

=======
    public function canResolve()
    {
        $accept = $this->accept;
>>>>>>> master
        return $accept->hasMediaType('json') || $accept->hasMediaType('application/json');
    }
}
