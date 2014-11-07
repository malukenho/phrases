<?php
namespace Phrases\Http\Response\Type;

use Zend\Http\Response;
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
    public function response()
    {
        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->setContent($this->phrase);
        $response->getHeaders()->addHeaders([
            'Content-Type' => 'text/plain'
        ]);

        return $response;
    }

    /**
     * {@inheritDoc}
     */
    public function canResolve()
    {
        $accept = $this->accept;
        return $accept->hasMediaType('plain') || $accept->hasMediaType('text/plain');
    }
}
