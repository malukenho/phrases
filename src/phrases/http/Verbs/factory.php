<?php
namespace Phrases\HTTP\Verbs;

class Factory
{
  
  private function __construct(){}

  public static function getMethod($httpVerb)
  {
    $httpVerb = __NAMESPACE__.'\\'. $httpVerb;
    return new $httpVerb();
  }

}