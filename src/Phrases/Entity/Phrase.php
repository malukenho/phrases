<?php

namespace Phrases\Entity;

use \InvalidArgumentException;

class Phrase
{
    protected $title;
    protected $text;

    public function __construct($title, $text)
    {
        $this->title = trim($title);
        $this->text  = trim($text);

        if (empty($this->title)) {
            throw new InvalidArgumentException('Title empty not valid');
        }

        if (empty($this->text)) {
            throw new InvalidArgumentException('Text empty not valid');
        }
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

