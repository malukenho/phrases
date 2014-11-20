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
        return '[Jack Makiyama]' == $response->getBody();
    }
}
