<?php

namespace Phrases\Entity;

class Phrase
{
    protected $title;
    protected $text;

    public function __construct($title, $text)
    {
        $this->title = $title;
        $this->text  = $text;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getText()
    {
        return $this->text;
    }
}
