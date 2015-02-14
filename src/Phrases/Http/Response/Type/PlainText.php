<?php
namespace Phrases\Http\Response\Type;

<<<<<<< HEAD
use Zend\Http;
=======
use Zend\Http\Response;
>>>>>>> master
use Phrases\Http\Response\AbstractResponse;

/**
 * Response a request does accept PlainText representation
 *
 * @author Jefersson Nathan <malukenho@phpse.net>
 */
class PlainText extends AbstractResponse
{
    /**
     * {@inheritDoc}
     */
<<<<<<< HEAD
    public function serialize(Http\Response $response)
    {
        $response->getHeaders()->addHeaders([
            'Content-Type' => 'text/plain'
        ]);
        $content = $response->getContent();
        $content = htmlentities($content);
        $response->setContent((string) $content);
=======
    public function response()
    {
        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->setContent($this->phrase);
        $response->getHeaders()->addHeaders([
            'Content-Type' => 'text/plain'
        ]);
>>>>>>> master

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
        return $accept->hasMediaType('plain') || $accept->hasMediaType('text/plain');
    }
}
