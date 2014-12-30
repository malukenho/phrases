<?php

namespace Phrases\Entity;

use \InvalidArgumentException;

class Phrase
{
    protected $title;
    protected $text;

    public function setTitle($title)
    {
        if (empty($title)) {
            throw new InvalidArgumentException('Title empty not valid');
        }

        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setText($text)
    {
        if (empty($text)) {
            throw new InvalidArgumentException('Text empty not valid');
        }

        $this->text = $text;

        return $this;
    }

    public function getText()
    {
        return $this->text;
    }
}

