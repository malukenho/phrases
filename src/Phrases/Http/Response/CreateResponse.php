<?php
namespace Phrases\Http\Response;

use Zend\Http\Header\Accept;
use Phrases\Http\Response\Type\Json;
use Phrases\Http\Response\Type\PlainText;

/**
 * Create response based on Accept Resource.
 *
 * @author Jefersson Nathan <malukenho@phpse.net>
 */
class CreateResponse
{
    /**
     * Retrieve a valid response based on Accept header
     *
     * @param Accept $accept
     * @param String $phrase
     *
     * @return \Zend\Http\Response
     */
    public static function to(Accept $accept, $phrase)
    {
        $jsonResponse      = new Json($accept, $phrase);
        $plainTextResponse = new PlainText($accept, $phrase);

        $jsonResponse->setSuccessor($plainTextResponse);

        return $jsonResponse->handlerResponse();
    }
}
