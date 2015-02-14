<?php
namespace Phrases\Http\Response\Type;

use Zend\Http;
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
    public function serialize(Http\Response $response)
    {
        $response->getHeaders()->addHeaders([
            'Content-Type' => 'text/plain'
        ]);
        $content = $response->getContent();
        $content = htmlentities($content);
        $response->setContent((string) $content);

        return $response;
    }

    /**
     * {@inheritDoc}
     */
    public function canResolve(Http\Request $request)
    {
        $accept = $request->getHeaders()->get('Accept');

        return $accept->hasMediaType('plain') || $accept->hasMediaType('text/plain');
    }
}
