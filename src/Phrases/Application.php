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
}
