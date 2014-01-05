<?php
namespace Phrases\HTTP\Verbs;

class GET implements VerbInterface
{
    public function action($information, $fileReader)
    {
        return true;
    }
}