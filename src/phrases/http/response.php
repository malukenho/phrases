<?php
namespace Phrases\HTTP;

class Response
{
    public function __construct($statusCode, $message)
    {
        header("HTTP/1.1 {$statusCode} {$message}");
    }
}