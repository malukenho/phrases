<?php
namespace Phrases;

class Application
{
    private $phrases;

    public function __construct(array $phrases)
    {
        $this->phrases = $phrases;
    }

    public function getPhrases()
    {
        return $this->phrases;
    }

    public function getOnePhrase()
    {
    	return $this->phrases[0];
    }

    public function run()
    {
    	echo $this->getOnePhrase();
    }
}
