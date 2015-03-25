<?php
namespace Phrases\Http\Response\Type;

use Zend\Http;
use Phrases\Http\Response\AbstractResponse;

/**
 * Response a request does accept PlainText representation
 *
 * @author Jefersson Nathan <malukenho@phpse.net>
 */
class Html extends AbstractResponse
{
    /**
     * {@inheritDoc}
     */
    public function serialize(Http\Response $response)
    {
        $response->getHeaders()->addHeaders([
            'Content-Type' => 'text/html'
        ]);
        $content = $response->getContent();
        $content = htmlentities($content);
        $response->setContent("<strong>{$content}</strong>");

        return $response;
    }

    /**
     * {@inheritDoc}
     */
    public function canResolve(Http\Request $request)
    {
        $accept = $request->getHeaders()->get('Accept');

        return $accept->hasMediaType('html') || $accept->hasMediaType('text/html');
    }
}
