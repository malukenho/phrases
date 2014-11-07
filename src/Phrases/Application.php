<?php
namespace Phrases;

class Application
{
    /**
     * @var array
     */
    private $phrases;

    /**
     * Constructor.
     *
     * @param array $phrases
     */
    public function __construct(array $phrases)
    {
        $this->phrases = $phrases;
    }

    /**
     * Return all Phrase
     *
     * @return array
     */
    public function getPhrases()
    {
        return $this->phrases;
    }

    /**
     * Return the single first phrase
     *
     * @return mixed
     */
    public function getOnePhrase()
    {
    	return $this->phrases[0];
    }

    /**
     * Response to a Request
     *
     * @return void
     */
    public function run()
    {
    	echo $this->getOnePhrase();
    }
}
