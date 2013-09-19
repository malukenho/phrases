<?php
namespace Phrases;

class BadRequest
{
    public function __construct($statusCode, $message)
    {
        header("HTTP/1.1 {$statusCode} {$message}");
    }
}