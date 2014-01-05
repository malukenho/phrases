<?php
namespace Phrases\HTTP\Verbs;

interface VerbInterface
{
	public function action($fileReader);
}