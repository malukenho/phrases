<?php
namespace Phrases\Http\Response\Type;

use Zend\Http;
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
    public function serialize(Http\Response $response)
    {
        $content = $response->getContent();
        $response->setContent(json_encode($content));
        $response->getHeaders()->addHeaders([
            'Content-Type' => 'application/json'
        ]);

        return $response;
    }

    /**
     * {@inheritDoc}
     */
    public function canResolve(Http\Request $request)
    {
        $accept = $request->getHeaders()->get('Accept');

        return $accept->hasMediaType('json') || $accept->hasMediaType('application/json');
    }
}
