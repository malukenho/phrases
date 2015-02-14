<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Zend\Http\Headers;
use Zend\Http\Request;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * @var Phrases\Application
     */
    private $application;

    /**
     * @var Request
     */
    private $request;
<<<<<<< HEAD
    private $phrase;
    private $statusCode;
=======
>>>>>>> master

    /**
     * @Given a new Request object
     */
    public function aNewRequestObject()
    {
        $this->request = new Request();
    }

    /**
     * @Given this object need a specific application\/json Accept HTTP header
     */
    public function thisObjectNeedASpecificApplicationJsonAcceptHttpHeader()
    {
        $headerString = <<<EOB
Accept: application/json
EOB;

        $this->request->setHeaders(
            Headers::fromString($headerString)
        );
    }

    /**
     * @When I access the page
     */
    public function iAccessThePage()
    {
        $this->application = new Phrases\Application(['Jack Makiyama'], $this->request);
    }

    /**
     * @Then I get a phrase in json format
     */
    public function iGetAPhraseInJsonFormat()
    {
        /** @var $response Zend\Http\Response */
        $response = $this->application->fetchResponse();
<<<<<<< HEAD
        $response->getBody();
    }

    /**
     * @Given a phrase :phrase
     */
    public function createAPhrase($phrase)
    {
        $this->phrase = new StdClass();
        $this->phrase->text = $phrase;
    }

    /**
     * @Given a title :title
     */ 
    public function setTitleIntoPhrase($title)
    {
        $this->phrase->title = $title;
    }

    /**
     * @When I POST the phrase to :resource
     */
    public function createPostRequest($resource)
    {
        $ch = curl_init('http://localhost');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'title' => $this->phrase->title,
            'text' => $this->phrase->text,
        ]);

        curl_exec($ch);
        $this->statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    }

    /**
     * @Then HTTP status code should be :statusCode
     */ 
    public function checkReponseStatusCode($statusCode)
    {
        if ($this->statusCode !== $statusCode) {
            throw new Exception(
                sprintf('Expected status code %s received %s', $statusCode, $this->statusCode)
            );
        }
=======
        return '[Jack Makiyama]' == $response->getBody();
>>>>>>> master
    }
}
