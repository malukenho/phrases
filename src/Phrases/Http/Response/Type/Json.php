<?php
namespace Phrases\Http\Response\Type;

use Zend\Http\Response;
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
    public function response()
    {
        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->setContent(json_encode([$this->phrase]));
        $response->getHeaders()->addHeaders([
            'Content-Type' => 'application/json'
        ]);

        return $response;
    }

    /**
     * {@inheritDoc}
     */
    public function canResolve()
    {
        $accept = $this->accept;
        return $accept->hasMediaType('json') || $accept->hasMediaType('application/json');
    }
}
