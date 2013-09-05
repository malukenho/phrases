<?php
namespace Phrases\Services\ProviderRequestMethod;

interface RequestMethod
{
	public function response();
	public function getStatusCode();
	public function parseRequest();
}