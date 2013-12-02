<?php
namespace Phrase\Reader;

class Phrase
{
	private $_reader;

	public function __construct(PhraseServer $reader = null)
	{
		$this->_reader = $reader;
	}

	public function getPhraseWithSlug()
	{
		return $this->_reader->getPhraseWithSlug();
	}
}