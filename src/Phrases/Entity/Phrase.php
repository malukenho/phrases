<?php

namespace Phrases\Entity;

use Cocur\Slugify\Slugify;

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

    public function getSlug()
    {
        return '/' . (new Slugify())->slugify($this->getTitle());
    }
}
